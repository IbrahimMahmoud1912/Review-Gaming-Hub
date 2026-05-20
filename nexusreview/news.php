<?php
header('Content-Type: text/html; charset=utf-8');
require_once __DIR__ . '/config/db.php';

try {
    $pdo  = getDB();
    $stmt = $pdo->query("
        SELECT id, title, slug, category, image, bg_class, emoji,
               excerpt, body, author_name, read_time, created_at
        FROM news
        WHERE published = 1
        ORDER BY created_at DESC
    ");
    $articles = $stmt->fetchAll();
} catch (PDOException $e) {
    $articles = [];
}

$hero = $articles[0] ?? null;
$side = array_slice($articles, 1, 2);
$grid = array_slice($articles, 3);

// Build JS-safe map for the article overlay (slug → data)
$jsArticles = [];
foreach ($articles as $a) {
    $jsArticles[$a['slug']] = [
        'title'  => $a['title'],
        'cat'    => $a['category'],
        'author' => $a['author_name'],
        'date'   => date('F j Y', strtotime($a['created_at'])),
        'bg'     => $a['bg_class'],
        'emoji'  => $a['emoji'],
        'image'  => $a['image'] ?? '',
        'body'   => $a['body']
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>NexusReview — News</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Barlow:wght@300;400;500;600&family=Barlow+Condensed:wght@400;600;700&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box;}
:root{
  --bg:#0a0a0f;--bg2:#111118;--bg3:#17171f;--card:#1c1c26;--border:#2a2a3a;
  --accent:#e8ff3a;--accent2:#ff3a6e;--accent3:#3af0ff;
  --text:#e8e8f0;--muted:#6b6b80;
  --font-display:'Bebas Neue',sans-serif;
  --font-body:'Barlow',sans-serif;
  --font-cond:'Barlow Condensed',sans-serif;
}
body{background:var(--bg);color:var(--text);font-family:var(--font-body);font-size:15px;line-height:1.6;overflow-x:hidden;}
a{color:inherit;text-decoration:none;}
::-webkit-scrollbar{width:6px;}::-webkit-scrollbar-track{background:var(--bg2);}::-webkit-scrollbar-thumb{background:var(--border);border-radius:3px;}

nav{position:sticky;top:0;z-index:100;background:rgba(10,10,15,0.95);backdrop-filter:blur(12px);border-bottom:1px solid var(--border);}
.nav-inner{max-width:1400px;margin:0 auto;display:flex;align-items:center;gap:1.5rem;height:60px;padding:0 1.5rem;}
.logo{font-family:var(--font-display);font-size:26px;letter-spacing:2px;color:var(--accent);white-space:nowrap;cursor:pointer;flex-shrink:0;}
.logo span{color:var(--accent2);}
.nav-links{display:flex;gap:0;flex:1;}
.nav-links a{font-family:var(--font-cond);font-size:13px;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:var(--muted);padding:0 12px;height:60px;display:flex;align-items:center;border-bottom:2px solid transparent;transition:all .2s;white-space:nowrap;}
.nav-links a:hover,.nav-links a.active{color:var(--text);border-bottom-color:var(--accent);}
.nav-right{display:flex;align-items:center;gap:10px;margin-left:auto;flex-shrink:0;}
.btn{font-family:var(--font-cond);font-size:13px;font-weight:600;letter-spacing:1px;text-transform:uppercase;padding:8px 16px;border-radius:5px;cursor:pointer;border:none;transition:all .15s;}
.btn-outline{background:transparent;border:1px solid var(--border);color:var(--muted);}
.btn-outline:hover{border-color:var(--text);color:var(--text);}
.btn-accent{background:var(--accent);color:#0a0a0f;}
.btn-accent:hover{background:#fff;}
.hamburger{display:none;flex-direction:column;gap:5px;cursor:pointer;background:none;border:none;padding:4px;}
.hamburger span{display:block;width:22px;height:2px;background:var(--text);border-radius:2px;}
.mobile-menu{display:none;position:fixed;inset:0;top:60px;background:rgba(10,10,15,0.98);z-index:99;flex-direction:column;padding:1.5rem;gap:4px;}
.mobile-menu.open{display:flex;}
.mobile-menu a{font-family:var(--font-cond);font-size:18px;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:var(--muted);padding:14px 0;border-bottom:1px solid var(--border);}

/* PAGE HEADER */
.page-header{background:var(--bg2);border-bottom:1px solid var(--border);padding:3rem 1.5rem;}
.page-header-inner{max-width:1400px;margin:0 auto;}
.page-header h1{font-family:var(--font-display);font-size:clamp(48px,8vw,80px);letter-spacing:3px;line-height:.9;margin-bottom:12px;}
.page-header h1 span{color:var(--accent3);}
.page-header p{color:var(--muted);font-size:15px;max-width:500px;}

/* CATEGORY FILTER */
.cat-bar{max-width:1400px;margin:2rem auto 0;padding:0 1.5rem;}
.cat-chips{display:flex;gap:8px;flex-wrap:wrap;}
.cat-chip{font-family:var(--font-cond);font-size:13px;font-weight:600;letter-spacing:.5px;padding:6px 16px;border-radius:20px;border:1px solid var(--border);color:var(--muted);cursor:pointer;transition:all .15s;background:transparent;}
.cat-chip:hover{border-color:var(--muted);color:var(--text);}
.cat-chip.active{background:var(--accent3);border-color:var(--accent3);color:#0a0a0f;}

/* NEWS GRID */
.news-page{max-width:1400px;margin:0 auto;padding:2.5rem 1.5rem;}
.featured-news{display:grid;grid-template-columns:2fr 1fr;gap:20px;margin-bottom:2.5rem;}
.article-hero{background:var(--card);border:1px solid var(--border);border-radius:12px;overflow:hidden;cursor:pointer;transition:border-color .2s;}
.article-hero:hover{border-color:var(--accent3);}
.article-hero-img{height:280px;display:flex;align-items:center;justify-content:center;font-size:80px;overflow:hidden;position:relative;}
.article-hero-img img{width:100%;height:100%;object-fit:cover;position:absolute;inset:0;}
.article-hero-img .img-emoji{position:relative;z-index:1;}
.article-body{padding:1.5rem;}
.article-cat{font-family:var(--font-cond);font-size:11px;font-weight:600;letter-spacing:2px;text-transform:uppercase;color:var(--accent3);margin-bottom:10px;}
.article-body h2{font-family:var(--font-cond);font-size:26px;font-weight:700;line-height:1.25;margin-bottom:10px;}
.article-body p{color:var(--muted);font-size:14px;line-height:1.7;margin-bottom:12px;}
.article-meta{display:flex;align-items:center;gap:12px;font-size:12px;color:var(--muted);}
.article-meta .author{color:var(--text);font-weight:600;}
.article-tag{background:var(--bg2);border:1px solid var(--border);padding:2px 10px;border-radius:12px;font-family:var(--font-cond);font-size:11px;}

.side-articles{display:flex;flex-direction:column;gap:12px;}
.side-card{background:var(--card);border:1px solid var(--border);border-radius:10px;overflow:hidden;cursor:pointer;transition:border-color .2s;}
.side-card:hover{border-color:var(--accent3);}
.side-card-img{height:110px;display:flex;align-items:center;justify-content:center;font-size:36px;overflow:hidden;position:relative;}
.side-card-img img{width:100%;height:100%;object-fit:cover;position:absolute;inset:0;}
.side-card-img .img-emoji{position:relative;z-index:1;}
.side-card-body{padding:.9rem;}
.side-card-body .article-cat{margin-bottom:4px;}
.side-card-body h3{font-family:var(--font-cond);font-size:15px;font-weight:700;line-height:1.3;margin-bottom:6px;}
.side-card-body .article-meta{font-size:11px;}

/* ARTICLE GRID */
.section-divider{display:flex;align-items:center;gap:16px;margin-bottom:1.5rem;}
.section-divider h2{font-family:var(--font-display);font-size:32px;letter-spacing:2px;}
.section-divider h2 span{color:var(--accent3);}
.section-divider hr{flex:1;border:none;border-top:1px solid var(--border);}
.articles-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:20px;margin-bottom:3rem;}
.article-card{background:var(--card);border:1px solid var(--border);border-radius:10px;overflow:hidden;cursor:pointer;transition:transform .2s,border-color .2s;display:flex;flex-direction:column;}
.article-card:hover{transform:translateY(-4px);border-color:var(--accent3);}
.article-card.hidden{display:none;}
.article-card-img{height:160px;display:flex;align-items:center;justify-content:center;font-size:48px;overflow:hidden;position:relative;}
.article-card-img img{width:100%;height:100%;object-fit:cover;position:absolute;inset:0;}
.article-card-img .img-emoji{position:relative;z-index:1;}
.article-card-body{padding:1.1rem;flex:1;display:flex;flex-direction:column;}
.article-card-body h3{font-family:var(--font-cond);font-size:17px;font-weight:700;line-height:1.35;margin-bottom:8px;}
.article-card-body p{color:var(--muted);font-size:13px;line-height:1.6;flex:1;}
.article-card-footer{margin-top:12px;display:flex;align-items:center;justify-content:space-between;}
.read-time{font-size:11px;color:var(--muted);}
.read-more{font-family:var(--font-cond);font-size:12px;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:var(--accent3);cursor:pointer;}

/* FULL ARTICLE OVERLAY */
.article-overlay{position:fixed;inset:0;background:rgba(0,0,0,.9);z-index:500;display:none;overflow-y:auto;}
.article-overlay.open{display:block;}
.article-full{max-width:760px;margin:0 auto;padding:3rem 1.5rem;}
.article-full-close{position:sticky;top:1rem;float:right;background:var(--bg3);border:1px solid var(--border);border-radius:6px;padding:6px 14px;font-family:var(--font-cond);font-size:13px;font-weight:600;color:var(--muted);cursor:pointer;margin-bottom:1rem;transition:all .2s;}
.article-full-close:hover{color:var(--text);border-color:var(--text);}
.article-full-img{width:100%;height:320px;border-radius:12px;overflow:hidden;margin-bottom:2rem;display:flex;align-items:center;justify-content:center;font-size:80px;position:relative;}
.article-full-img img{width:100%;height:100%;object-fit:cover;position:absolute;inset:0;}
.article-full-img .img-emoji{position:relative;z-index:1;}
.article-full h1{font-family:var(--font-cond);font-size:clamp(24px,4vw,36px);font-weight:700;line-height:1.2;margin-bottom:16px;}
.article-full-meta{display:flex;flex-wrap:wrap;gap:12px;align-items:center;margin-bottom:2rem;padding-bottom:1.5rem;border-bottom:1px solid var(--border);}
.article-full-body p{color:var(--muted);font-size:15px;line-height:1.8;margin-bottom:1.2rem;}
.article-full-body h3{font-family:var(--font-cond);font-size:22px;font-weight:700;margin:1.5rem 0 .8rem;color:var(--text);}
.article-full-body blockquote{border-left:3px solid var(--accent3);padding-left:1.2rem;color:var(--text);font-size:16px;font-style:italic;margin:1.5rem 0;}

.empty-state{text-align:center;padding:4rem 1.5rem;color:var(--muted);}
.empty-state h2{font-family:var(--font-display);font-size:48px;color:var(--border);margin-bottom:1rem;}

footer{border-top:1px solid var(--border);background:var(--bg2);padding:2rem 1.5rem;text-align:center;color:var(--muted);font-size:13px;}
.bg-g1{background:linear-gradient(135deg,#1a0a2e,#2a0060);}
.bg-g2{background:linear-gradient(135deg,#0a1a2e,#004060);}
.bg-g3{background:linear-gradient(135deg,#0a2e0a,#006020);}
.bg-g4{background:linear-gradient(135deg,#2e0a0a,#600010);}
.bg-g5{background:linear-gradient(135deg,#2e2a0a,#604010);}
.bg-g6{background:linear-gradient(135deg,#0a2e2e,#006060);}
.bg-g7{background:linear-gradient(135deg,#1a1a0a,#404000);}

@media(max-width:900px){
  .nav-links{display:none;}.hamburger{display:flex;}
  .featured-news{grid-template-columns:1fr;}
  .articles-grid{grid-template-columns:repeat(auto-fill,minmax(260px,1fr));}
}
@media(max-width:600px){
  .articles-grid{grid-template-columns:1fr;}
  .nav-inner{padding:0 1rem;}
}
</style>
</head>
<body>

<nav>
  <div class="nav-inner">
    <a href="index.php" class="logo">NEXUS<span>REVIEW</span></a>
    <div class="nav-links">
      <a href="index.php#games">Games</a>
      <a href="index.php#trending">Trending</a>
      <a href="news.php" class="active">News</a>
      <a href="index.php#reviews">Reviews</a>
      <a href="index.php#charts">Top Charts</a>
      <a href="index.php#consoles">Consoles</a>
    </div>
    <div class="nav-right">
      <button class="btn btn-outline">Log In</button>
      <button class="btn btn-accent">Sign Up</button>
      <button class="hamburger" onclick="document.getElementById('mob-menu').classList.toggle('open')">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>
</nav>
<div class="mobile-menu" id="mob-menu">
  <a href="index.php#games">Games</a>
  <a href="index.php#trending">Trending</a>
  <a href="news.php">News</a>
  <a href="index.php#reviews">Reviews</a>
  <a href="index.php#charts">Top Charts</a>
  <a href="index.php#consoles">Consoles</a>
</div>

<div class="article-overlay" id="article-overlay">
  <div class="article-full" id="article-full-content"></div>
</div>

<div class="page-header">
  <div class="page-header-inner">
    <h1>GAMING <span>NEWS</span></h1>
    <p>The latest from the gaming world — hardware announcements game updates esports and in-depth reviews.</p>
  </div>
</div>

<div class="cat-bar">
  <div class="cat-chips">
    <div class="cat-chip active" onclick="filterCat('All',this)">All</div>
    <div class="cat-chip" onclick="filterCat('Industry',this)">Industry</div>
    <div class="cat-chip" onclick="filterCat('Update',this)">Updates</div>
    <div class="cat-chip" onclick="filterCat('Review',this)">Reviews</div>
    <div class="cat-chip" onclick="filterCat('Esports',this)">Esports</div>
    <div class="cat-chip" onclick="filterCat('Hardware',this)">Hardware</div>
    <div class="cat-chip" onclick="filterCat('DLC',this)">DLC &amp; Expansions</div>
  </div>
</div>

<div class="news-page">

<?php if (empty($articles)): ?>
  <div class="empty-state">
    <h2>NO ARTICLES</h2>
    <p>Run <code>setup.php</code> to seed the database then refresh this page.</p>
  </div>
<?php else: ?>

  <?php
  $featuredCats = array_filter(array_merge(
      $hero ? [$hero['category']] : [],
      array_column($side, 'category')
  ));
  ?>
  <div class="featured-news" id="featured-zone"
       data-cats="<?= htmlspecialchars(implode(',', $featuredCats)) ?>">

    <?php if ($hero): ?>
    <div class="article-hero" onclick="openArticle('<?= htmlspecialchars($hero['slug']) ?>')">
      <div class="article-hero-img <?= htmlspecialchars($hero['bg_class']) ?>">
        <?php if (!empty($hero['image'])): ?>
          <img src="<?= htmlspecialchars($hero['image']) ?>" alt="<?= $hero['emoji'] ?> <?= htmlspecialchars($hero['title']) ?>" onerror="this.outerHTML='<div class=&quot;img-emoji&quot;><?= $hero['emoji'] ?></div>'">
        <?php else: ?>
          <div class="img-emoji"><?= $hero['emoji'] ?></div>
        <?php endif; ?>
      </div>
      <div class="article-body">
        <div class="article-cat"><?= htmlspecialchars($hero['category']) ?></div>
        <h2><?= htmlspecialchars($hero['title']) ?></h2>
        <p><?= htmlspecialchars($hero['excerpt']) ?></p>
        <div class="article-meta">
          <span class="author"><?= htmlspecialchars($hero['author_name']) ?></span>
          <span><?= date('F j Y', strtotime($hero['created_at'])) ?></span>
          <span class="article-tag"><?= htmlspecialchars($hero['category']) ?></span>
          <span><?= htmlspecialchars($hero['read_time']) ?> read</span>
        </div>
      </div>
    </div>
    <?php endif; ?>

    <?php if (!empty($side)): ?>
    <div class="side-articles">
      <?php foreach ($side as $s): ?>
      <div class="side-card" onclick="openArticle('<?= htmlspecialchars($s['slug']) ?>')">
        <div class="side-card-img <?= htmlspecialchars($s['bg_class']) ?>">
          <?php if (!empty($s['image'])): ?>
            <img src="<?= htmlspecialchars($s['image']) ?>" alt="<?= $s['emoji'] ?> <?= htmlspecialchars($s['title']) ?>" onerror="this.outerHTML='<div class=&quot;img-emoji&quot;><?= $s['emoji'] ?></div>'">
          <?php else: ?>
            <div class="img-emoji"><?= $s['emoji'] ?></div>
          <?php endif; ?>
        </div>
        <div class="side-card-body">
          <div class="article-cat"><?= htmlspecialchars($s['category']) ?></div>
          <h3><?= htmlspecialchars($s['title']) ?></h3>
          <div class="article-meta">
            <span class="author"><?= htmlspecialchars($s['author_name']) ?></span>
            <span><?= date('F j', strtotime($s['created_at'])) ?></span>
            <span class="article-tag"><?= htmlspecialchars($s['category']) ?></span>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

  </div>

  <div class="section-divider"><h2>ALL <span>ARTICLES</span></h2><hr></div>
  <div class="articles-grid" id="articles-grid">
    <?php foreach ($grid as $a): ?>
    <div class="article-card" data-cat="<?= htmlspecialchars($a['category']) ?>"
         onclick="openArticle('<?= htmlspecialchars($a['slug']) ?>')">
      <div class="article-card-img <?= htmlspecialchars($a['bg_class']) ?>">
        <?php if (!empty($a['image'])): ?>
          <img src="<?= htmlspecialchars($a['image']) ?>" alt="<?= $a['emoji'] ?> <?= htmlspecialchars($a['title']) ?>" onerror="this.outerHTML='<div class=&quot;img-emoji&quot;><?= $a['emoji'] ?></div>'">
        <?php else: ?>
          <div class="img-emoji"><?= $a['emoji'] ?></div>
        <?php endif; ?>
      </div>
      <div class="article-card-body">
        <div class="article-cat"><?= htmlspecialchars($a['category']) ?></div>
        <h3><?= htmlspecialchars($a['title']) ?></h3>
        <p><?= htmlspecialchars($a['excerpt']) ?></p>
        <div class="article-card-footer">
          <span class="read-time"><?= date('F j', strtotime($a['created_at'])) ?> · <?= htmlspecialchars($a['read_time']) ?></span>
          <span class="read-more">Read →</span>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>

<?php endif; ?>
</div>

<footer>
  <a href="index.php" class="logo" style="display:inline-block;margin-bottom:8px;">NEXUS<span style="color:var(--accent2)">REVIEW</span></a>
  <p>© 2026 NexusReview · Built for gamers by gamers</p>
</footer>

<script>
const ARTICLES = <?= json_encode($jsArticles, JSON_HEX_TAG) ?>;

function openArticle(id) {
  const a = ARTICLES[id];
  if (!a) return;
  const overlay = document.getElementById('article-overlay');
  
  const imgHtml = a.image 
    ? `<img src="${a.image}" alt="${a.emoji} ${a.title}" onerror="this.outerHTML='<div class=\\'img-emoji\\'>${a.emoji}</div>'">`
    : `<div class="img-emoji">${a.emoji}</div>`;

  document.getElementById('article-full-content').innerHTML = `
    <button class="article-full-close" onclick="closeArticle()">← Back to News</button>
    <div class="article-full-img ${a.bg}">
      ${imgHtml}
    </div>
    <div class="article-cat" style="color:var(--accent3);font-family:var(--font-cond);font-size:12px;font-weight:600;letter-spacing:2px;text-transform:uppercase;margin-bottom:10px;">${a.cat}</div>
    <h1>${a.title}</h1>
    <div class="article-full-meta">
      <span style="font-weight:600;color:var(--text);">${a.author}</span>
      <span style="color:var(--muted);">${a.date}</span>
      <span class="article-tag">${a.cat}</span>
    </div>
    <div class="article-full-body">${a.body}</div>`;
  overlay.classList.add('open');
  overlay.scrollTop = 0;
}

function closeArticle() {
  document.getElementById('article-overlay').classList.remove('open');
}

window.addEventListener('load', () => {
  const hash = window.location.hash.replace('#', '');
  if (hash && ARTICLES[hash]) openArticle(hash);
});

function filterCat(cat, el) {
  document.querySelectorAll('.cat-chip').forEach(c => c.classList.remove('active'));
  el.classList.add('active');
  document.querySelectorAll('.article-card').forEach(c => {
    c.classList.toggle('hidden', cat !== 'All' && c.dataset.cat !== cat);
  });
  const featured = document.getElementById('featured-zone');
  if (featured) {
    const cats = (featured.dataset.cats || '').split(',');
    featured.style.display = (cat === 'All' || cats.includes(cat)) ? '' : 'none';
  }
}
</script>
</body>
</html>