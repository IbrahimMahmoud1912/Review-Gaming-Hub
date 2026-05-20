<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>NexusReview — Gaming Hub</title>
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

/* ── NAV ── */
nav{position:sticky;top:0;z-index:100;background:rgba(10,10,15,0.95);backdrop-filter:blur(12px);border-bottom:1px solid var(--border);}
.nav-inner{max-width:1400px;margin:0 auto;display:flex;align-items:center;gap:1.5rem;height:60px;padding:0 1.5rem;}
.logo{font-family:var(--font-display);font-size:26px;letter-spacing:2px;color:var(--accent);white-space:nowrap;cursor:pointer;flex-shrink:0;}
.logo span{color:var(--accent2);}
.nav-links{display:flex;gap:0;flex:1;}
.nav-links a{font-family:var(--font-cond);font-size:13px;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:var(--muted);padding:0 12px;height:60px;display:flex;align-items:center;border-bottom:2px solid transparent;transition:all .2s;white-space:nowrap;}
.nav-links a:hover,.nav-links a.active{color:var(--text);border-bottom-color:var(--accent);}
.nav-right{display:flex;align-items:center;gap:10px;margin-left:auto;flex-shrink:0;}
/* search */
.search-wrap{position:relative;}
.search-bar{background:var(--bg3);border:1px solid var(--border);border-radius:6px;padding:7px 32px 7px 34px;font-family:var(--font-body);font-size:13px;color:var(--text);width:200px;outline:none;transition:all .25s;}
.search-bar:focus{border-color:var(--accent);width:260px;}
.search-bar::placeholder{color:var(--muted);}
.search-icon{position:absolute;left:11px;top:50%;transform:translateY(-50%);color:var(--muted);font-size:14px;pointer-events:none;}
.search-clear{position:absolute;right:8px;top:50%;transform:translateY(-50%);background:none;border:none;color:var(--muted);cursor:pointer;font-size:16px;display:none;line-height:1;padding:2px;}
.search-clear:hover{color:var(--text);}
.search-dropdown{position:absolute;top:calc(100% + 6px);left:0;right:0;background:var(--bg3);border:1px solid var(--border);border-radius:8px;overflow:hidden;z-index:200;display:none;box-shadow:0 8px 32px rgba(0,0,0,.5);min-width:320px;}
.search-dropdown.open{display:block;}
.search-section-label{font-family:var(--font-cond);font-size:10px;font-weight:600;letter-spacing:2px;text-transform:uppercase;color:var(--muted);padding:8px 14px 4px;}
.search-item{display:flex;align-items:center;gap:10px;padding:9px 14px;cursor:pointer;transition:background .1s;}
.search-item:hover,.search-item.focused{background:var(--bg2);}
.search-item-icon{width:36px;height:36px;border-radius:6px;overflow:hidden;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:18px;}
.search-item-icon img{width:100%;height:100%;object-fit:cover;}
.search-item-info{flex:1;min-width:0;}
.search-item-title{font-family:var(--font-cond);font-size:14px;font-weight:700;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.search-item-title mark{background:none;color:var(--accent);font-style:normal;}
.search-item-meta{font-size:11px;color:var(--muted);}
.search-item-score{font-family:var(--font-display);font-size:16px;color:var(--accent);flex-shrink:0;}
.search-no-results{padding:16px 14px;text-align:center;color:var(--muted);font-size:13px;}
.search-footer{border-top:1px solid var(--border);padding:8px 14px;font-size:11px;color:var(--muted);display:flex;justify-content:space-between;}
.search-footer kbd{background:var(--bg2);border:1px solid var(--border);border-radius:3px;padding:1px 5px;font-size:10px;}
/* hamburger */
.hamburger{display:none;flex-direction:column;gap:5px;cursor:pointer;background:none;border:none;padding:4px;}
.hamburger span{display:block;width:22px;height:2px;background:var(--text);border-radius:2px;transition:all .3s;}
.mobile-menu{display:none;position:fixed;inset:0;top:60px;background:rgba(10,10,15,0.98);z-index:99;flex-direction:column;padding:1.5rem;gap:4px;overflow-y:auto;}
.mobile-menu.open{display:flex;}
.mobile-menu a{font-family:var(--font-cond);font-size:18px;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:var(--muted);padding:14px 0;border-bottom:1px solid var(--border);}
.mobile-menu a:hover{color:var(--text);}
.mobile-menu-actions{display:flex;gap:10px;margin-top:1rem;}

.btn{font-family:var(--font-cond);font-size:13px;font-weight:600;letter-spacing:1px;text-transform:uppercase;padding:8px 16px;border-radius:5px;cursor:pointer;border:none;transition:all .15s;}
.btn-outline{background:transparent;border:1px solid var(--border);color:var(--muted);}
.btn-outline:hover{border-color:var(--text);color:var(--text);}
.btn-accent{background:var(--accent);color:#0a0a0f;}
.btn-accent:hover{background:#fff;transform:translateY(-1px);}
.btn-review{background:transparent;border:1px solid var(--accent2);color:var(--accent2);font-family:var(--font-cond);font-size:12px;font-weight:600;letter-spacing:1px;text-transform:uppercase;padding:5px 12px;border-radius:4px;cursor:pointer;transition:all .15s;width:100%;margin-top:8px;}
.btn-review:hover{background:var(--accent2);color:#fff;}

/* ── MODALS ── */
.modal-overlay{position:fixed;inset:0;background:rgba(0,0,0,.85);z-index:999;display:none;align-items:center;justify-content:center;padding:1rem;}
.modal-overlay.open{display:flex;}
.modal{background:var(--bg3);border:1px solid var(--border);border-radius:12px;padding:2.5rem;width:100%;max-width:420px;position:relative;max-height:90vh;overflow-y:auto;}
.modal h2{font-family:var(--font-display);font-size:32px;letter-spacing:2px;margin-bottom:4px;}
.modal-desc{color:var(--muted);font-size:13px;margin-bottom:1.5rem;}
.modal-close{position:absolute;top:16px;right:16px;background:none;border:none;color:var(--muted);font-size:20px;cursor:pointer;line-height:1;}
.modal-close:hover{color:var(--text);}
.form-group{margin-bottom:1rem;}
.form-group label{display:block;font-family:var(--font-cond);font-size:12px;font-weight:600;letter-spacing:1px;text-transform:uppercase;color:var(--muted);margin-bottom:6px;}
.form-group input,.form-group textarea,.form-group select{width:100%;background:var(--bg2);border:1px solid var(--border);border-radius:6px;padding:10px 14px;color:var(--text);font-family:var(--font-body);font-size:14px;outline:none;transition:border .2s;}
.form-group input:focus,.form-group textarea:focus,.form-group select:focus{border-color:var(--accent);}
.form-group textarea{resize:vertical;min-height:90px;}
.form-group select option{background:var(--bg2);}
.modal-tabs{display:flex;border-bottom:1px solid var(--border);margin-bottom:1.5rem;}
.modal-tab{font-family:var(--font-cond);font-size:14px;font-weight:600;letter-spacing:1px;text-transform:uppercase;padding:8px 20px;cursor:pointer;color:var(--muted);border-bottom:2px solid transparent;margin-bottom:-1px;transition:all .2s;background:none;border-left:none;border-right:none;border-top:none;}
.modal-tab.active{color:var(--accent);border-bottom-color:var(--accent);}
.score-slider-wrap{display:flex;align-items:center;gap:12px;}
.score-slider{flex:1;-webkit-appearance:none;appearance:none;height:6px;border-radius:3px;background:var(--border);outline:none;}
.score-slider::-webkit-slider-thumb{-webkit-appearance:none;appearance:none;width:20px;height:20px;border-radius:50%;background:var(--accent);cursor:pointer;}
.score-slider::-moz-range-thumb{width:20px;height:20px;border-radius:50%;background:var(--accent);cursor:pointer;border:none;}
.score-display{font-family:var(--font-display);font-size:36px;color:var(--accent);min-width:50px;text-align:center;line-height:1;}
.score-desc{font-size:11px;color:var(--muted);text-align:center;}

/* ── HERO ── */
.hero{position:relative;overflow:hidden;background:var(--bg2);}
.hero-bg{position:absolute;inset:0;background:linear-gradient(135deg,#0d0d1a 0%,#1a0d2e 40%,#0d1a1a 100%);}
.hero-grid{position:absolute;inset:0;background-image:linear-gradient(var(--border) 1px,transparent 1px),linear-gradient(90deg,var(--border) 1px,transparent 1px);background-size:60px 60px;opacity:.3;}
.hero-content{position:relative;z-index:2;max-width:1400px;margin:0 auto;padding:4rem 1.5rem;display:flex;align-items:center;gap:4rem;animation:fadeUp .6s ease both;}
.hero-text{flex:1;min-width:0;}
.hero-tag{font-family:var(--font-cond);font-size:12px;font-weight:600;letter-spacing:3px;text-transform:uppercase;color:var(--accent2);margin-bottom:12px;}
.hero-title{font-family:var(--font-display);font-size:clamp(52px,8vw,88px);line-height:.95;letter-spacing:2px;margin-bottom:16px;}
.hero-title .line2{color:var(--accent);text-shadow:0 0 40px rgba(232,255,58,.3);}
.hero-desc{color:var(--muted);max-width:380px;font-size:15px;margin-bottom:24px;}
.hero-actions{display:flex;gap:12px;align-items:center;flex-wrap:wrap;}
.hero-stats{display:flex;gap:2rem;margin-top:2rem;flex-wrap:wrap;}
.hero-stat-num{font-family:var(--font-display);font-size:28px;color:var(--accent);letter-spacing:1px;}
.hero-stat-label{font-size:12px;color:var(--muted);text-transform:uppercase;letter-spacing:1px;}
.hero-featured{flex:0 0 300px;}
.featured-card{background:var(--card);border:1px solid var(--border);border-radius:12px;overflow:hidden;}
.featured-img{height:170px;display:flex;align-items:center;justify-content:center;position:relative;overflow:hidden;}
.featured-img img{width:100%;height:100%;object-fit:cover;}
.featured-img .img-fallback{position:absolute;inset:0;display:flex;align-items:center;justify-content:center;font-size:56px;}
.featured-badge{position:absolute;top:12px;left:12px;background:var(--accent2);color:#fff;font-family:var(--font-cond);font-size:11px;font-weight:600;letter-spacing:1px;text-transform:uppercase;padding:3px 10px;border-radius:4px;z-index:1;}
.featured-body{padding:1rem;}
.featured-body h3{font-family:var(--font-cond);font-size:18px;font-weight:700;margin-bottom:4px;}
.featured-body p{color:var(--muted);font-size:12px;margin-bottom:10px;}
.score-big{font-family:var(--font-display);font-size:38px;color:var(--accent);line-height:1;}
.score-label{font-size:11px;color:var(--muted);}

/* ── SECTIONS ── */
.section{max-width:1400px;margin:0 auto;padding:3rem 1.5rem;}
.section-header{display:flex;align-items:baseline;gap:16px;margin-bottom:1.5rem;flex-wrap:wrap;}
.section-title{font-family:var(--font-display);font-size:36px;letter-spacing:2px;}
.section-title span{color:var(--accent);}
.section-sub{color:var(--muted);font-size:13px;margin-left:auto;}

/* ── FILTERS ── */
.filter-label{font-family:var(--font-cond);font-size:12px;font-weight:600;letter-spacing:1.5px;text-transform:uppercase;color:var(--muted);margin-bottom:6px;}
.filter-bar{display:flex;gap:8px;flex-wrap:wrap;margin-bottom:1.2rem;}
.filter-chip{font-family:var(--font-cond);font-size:13px;font-weight:600;letter-spacing:.5px;padding:6px 16px;border-radius:20px;border:1px solid var(--border);color:var(--muted);cursor:pointer;transition:all .15s;background:transparent;}
.filter-chip:hover{border-color:var(--muted);color:var(--text);}
.filter-chip.active{background:var(--accent);border-color:var(--accent);color:#0a0a0f;}

/* ── GAMES GRID ── */
.games-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(210px,1fr));gap:16px;}
.game-card{background:var(--card);border:1px solid var(--border);border-radius:10px;overflow:hidden;transition:transform .2s,border-color .2s;}
.game-card:hover{transform:translateY(-4px);border-color:var(--accent);}
.game-thumb{height:130px;position:relative;overflow:hidden;background:var(--bg2);}
.game-thumb img{width:100%;height:100%;object-fit:cover;display:block;}
.game-thumb .thumb-fallback{position:absolute;inset:0;display:flex;align-items:center;justify-content:center;font-size:40px;}
.game-thumb-label{position:absolute;bottom:8px;right:8px;font-family:var(--font-display);font-size:20px;background:rgba(0,0,0,.7);padding:2px 8px;border-radius:4px;color:var(--accent);}
.game-body{padding:.85rem;}
.game-title{font-family:var(--font-cond);font-size:15px;font-weight:700;margin-bottom:2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.game-title mark{background:none;color:var(--accent);font-style:normal;}
.game-genre{font-size:11px;font-family:var(--font-cond);font-weight:600;letter-spacing:1px;text-transform:uppercase;color:var(--accent3);margin-bottom:6px;}
.game-footer{display:flex;align-items:center;justify-content:space-between;margin-bottom:4px;}
.stars{color:var(--accent);font-size:13px;letter-spacing:1px;}
.score-pill{font-family:var(--font-display);font-size:18px;background:var(--bg2);border:1px solid var(--border);padding:2px 10px;border-radius:6px;color:var(--accent);}
.console-tags{display:flex;gap:4px;flex-wrap:wrap;margin-bottom:6px;}
.console-badge{font-size:10px;font-family:var(--font-cond);font-weight:600;letter-spacing:.5px;padding:2px 8px;border-radius:3px;text-transform:uppercase;}
.ps{background:#00439c22;color:#4a9eff;border:1px solid #00439c44;}
.xbox{background:#10752022;color:#50c878;border:1px solid #10752044;}
.pc{background:#ff6b0022;color:#ff9a44;border:1px solid #ff6b0044;}
.switch{background:#e6000022;color:#ff4444;border:1px solid #e6000044;}
.mobile-badge{background:#aa00ff22;color:#dd88ff;border:1px solid #aa00ff44;}
.ps4{background:#00439c15;color:#7ab8ff;border:1px solid #00439c33;}

/* ── TRENDING ── */
.trending-row{display:flex;gap:12px;overflow-x:auto;padding-bottom:8px;scrollbar-width:thin;}
.trending-card{flex:0 0 150px;background:var(--card);border:1px solid var(--border);border-radius:8px;overflow:hidden;cursor:pointer;transition:border-color .2s;}
.trending-card:hover{border-color:var(--accent2);}
.trend-img{height:85px;display:flex;align-items:center;justify-content:center;font-size:30px;position:relative;overflow:hidden;}
.trend-img img{width:100%;height:100%;object-fit:cover;position:absolute;inset:0;}
.trend-img .trend-emoji{position:relative;z-index:1;}
.trend-rank{position:absolute;top:5px;left:6px;font-family:var(--font-display);font-size:18px;color:rgba(255,255,255,.3);z-index:2;}
.trend-body{padding:.55rem .7rem;}
.trend-title{font-family:var(--font-cond);font-size:13px;font-weight:700;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.trend-change{font-size:11px;color:#50c878;}
.trend-change.down{color:var(--accent2);}

/* ── CHARTS ── */
.chart-list{display:flex;flex-direction:column;gap:8px;}
.chart-item{background:var(--card);border:1px solid var(--border);border-radius:8px;padding:.85rem 1rem;display:flex;align-items:center;gap:1rem;cursor:pointer;transition:border-color .2s;}
.chart-item:hover{border-color:var(--accent);}
.chart-rank{font-family:var(--font-display);font-size:26px;color:var(--border);width:32px;text-align:center;}
.chart-rank.top3{color:var(--accent);}
.chart-thumb{width:46px;height:46px;border-radius:6px;overflow:hidden;flex-shrink:0;background:var(--bg2);display:flex;align-items:center;justify-content:center;font-size:20px;}
.chart-thumb img{width:100%;height:100%;object-fit:cover;}
.chart-info{flex:1;min-width:0;}
.chart-name{font-family:var(--font-cond);font-size:15px;font-weight:700;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.chart-detail{font-size:12px;color:var(--muted);}
.chart-score{font-family:var(--font-display);font-size:26px;color:var(--accent);}

/* ── NEWS ── */
.news-main{background:var(--card);border:1px solid var(--border);border-radius:10px;overflow:hidden;cursor:pointer;transition:border-color .2s;text-decoration:none;display:block;}
.news-main:hover{border-color:var(--accent3);}
.news-img{height:190px;display:flex;align-items:center;justify-content:center;font-size:56px;overflow:hidden;}
.news-img img{width:100%;height:100%;object-fit:cover;}
.news-body{padding:1.1rem;}
.news-cat{font-family:var(--font-cond);font-size:11px;font-weight:600;letter-spacing:2px;text-transform:uppercase;color:var(--accent3);margin-bottom:8px;}
.news-body h3{font-family:var(--font-cond);font-size:20px;font-weight:700;line-height:1.3;margin-bottom:8px;}
.news-body p{color:var(--muted);font-size:13px;}
.news-mini{background:var(--card);border:1px solid var(--border);border-radius:8px;padding:.9rem;cursor:pointer;transition:border-color .2s;display:flex;gap:12px;text-decoration:none;}
.news-mini:hover{border-color:var(--accent3);}
.news-mini-img{width:52px;height:52px;border-radius:6px;display:flex;align-items:center;justify-content:center;font-size:22px;flex-shrink:0;background:var(--bg2);overflow:hidden;}
.news-mini-img img{width:100%;height:100%;object-fit:cover;}
.news-mini-cat{font-family:var(--font-cond);font-size:10px;font-weight:600;letter-spacing:1.5px;text-transform:uppercase;color:var(--accent3);}
.news-mini-title{font-family:var(--font-cond);font-size:13px;font-weight:600;line-height:1.3;margin-top:2px;}
.news-date{font-size:11px;color:var(--muted);margin-top:4px;}

/* ── REVIEWS ── */
.reviews-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(290px,1fr));gap:16px;}
.review-card{background:var(--card);border:1px solid var(--border);border-radius:10px;padding:1.25rem;}
.review-header{display:flex;align-items:center;gap:12px;margin-bottom:1rem;}
.avatar{width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-family:var(--font-display);font-size:18px;flex-shrink:0;}
.review-user{font-family:var(--font-cond);font-size:15px;font-weight:700;}
.review-date{font-size:11px;color:var(--muted);}
.review-game{font-family:var(--font-cond);font-size:13px;color:var(--accent);font-weight:600;margin-bottom:6px;}
.review-text{font-size:13px;color:var(--muted);line-height:1.6;margin-bottom:12px;}
.review-footer{display:flex;align-items:center;justify-content:space-between;}
.helpful{font-size:12px;color:var(--muted);cursor:pointer;}
.helpful:hover{color:var(--text);}

/* ── CONSOLES ── */
.consoles-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(160px,1fr));gap:12px;}
.console-card{background:var(--card);border:1px solid var(--border);border-radius:10px;padding:1.4rem;text-align:center;cursor:pointer;transition:all .2s;}
.console-card:hover{transform:translateY(-3px);}
.console-card.ps-card:hover{border-color:#4a9eff;background:rgba(0,67,156,.08);}
.console-card.xbox-card:hover{border-color:#50c878;background:rgba(16,117,32,.08);}
.console-card.pc-card:hover{border-color:#ff9a44;background:rgba(255,107,0,.08);}
.console-card.switch-card:hover{border-color:#ff4444;background:rgba(230,0,0,.08);}
.console-card.mobile-card:hover{border-color:#dd88ff;background:rgba(170,0,255,.08);}
.console-card.ps4-card:hover{border-color:#7ab8ff;background:rgba(0,67,156,.06);}
.console-icon{font-size:36px;margin-bottom:10px;}
.console-name{font-family:var(--font-cond);font-size:15px;font-weight:700;margin-bottom:4px;}
.console-count{font-size:12px;color:var(--muted);}

/* ── EMPTY / TOAST / FOOTER ── */
.no-results{grid-column:1/-1;text-align:center;padding:3rem;color:var(--muted);}
.no-results-icon{font-size:40px;margin-bottom:12px;}
.no-results p{font-family:var(--font-cond);font-size:18px;}
#toast{position:fixed;bottom:2rem;right:2rem;background:var(--accent);color:#0a0a0f;font-family:var(--font-cond);font-size:14px;font-weight:600;letter-spacing:1px;padding:12px 24px;border-radius:8px;z-index:9999;transform:translateY(80px);opacity:0;transition:all .3s;}
/* ── FOOTER ── */
.site-footer{background:var(--bg2);border-top:1px solid var(--border);}
.footer-accent-bar{height:3px;background:linear-gradient(90deg,var(--accent) 0%,var(--accent3) 50%,var(--accent2) 100%);}
.footer-inner{max-width:1400px;margin:0 auto;padding:3rem 1.5rem 0;}
.footer-top{display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:3rem;padding-bottom:2.5rem;border-bottom:1px solid var(--border);}
.footer-brand-logo{font-family:var(--font-display);font-size:30px;letter-spacing:3px;cursor:pointer;display:inline-block;margin-bottom:1rem;color:var(--accent);}
.footer-brand-logo span{color:var(--accent2);}
.footer-tagline{font-size:13px;color:var(--muted);line-height:1.7;max-width:260px;margin-bottom:1.5rem;}
.footer-socials{display:flex;gap:8px;}
.footer-social-btn{width:38px;height:38px;border-radius:8px;background:var(--card);border:1px solid var(--border);display:flex;align-items:center;justify-content:center;color:var(--muted);transition:all .2s;cursor:pointer;}
.footer-social-btn:hover{border-color:var(--accent);color:var(--accent);background:rgba(232,255,58,.06);transform:translateY(-2px);}
.footer-social-btn svg{width:15px;height:15px;fill:currentColor;flex-shrink:0;}
.footer-nav-col h4{font-family:var(--font-cond);font-size:11px;font-weight:700;letter-spacing:2.5px;text-transform:uppercase;color:var(--accent);margin-bottom:1.2rem;}
.footer-nav-col ul{list-style:none;}
.footer-nav-col ul li{margin-bottom:10px;}
.footer-nav-col ul li a{font-size:13px;color:var(--muted);transition:color .15s;}
.footer-nav-col ul li a:hover{color:var(--text);}
.footer-bottom{display:flex;align-items:center;justify-content:space-between;padding:1.25rem 0;gap:1rem;}
.footer-copy{font-size:12px;color:var(--muted);}
.footer-copy span{color:var(--accent);}
.footer-brands{display:flex;align-items:center;gap:16px;}
.footer-brands-label{font-family:var(--font-cond);font-size:10px;font-weight:700;letter-spacing:2px;text-transform:uppercase;color:var(--muted);opacity:.6;}
.footer-brand-tag{font-family:var(--font-cond);font-size:12px;font-weight:700;letter-spacing:1.5px;color:var(--muted);cursor:pointer;transition:color .15s;padding:4px 10px;border-radius:4px;border:1px solid transparent;}
.footer-brand-tag:hover{color:var(--text);border-color:var(--border);}
.footer-brand-tag.tag-box{background:var(--card);border-color:var(--border);color:var(--text);}
.footer-brand-tag.tag-italic{font-style:italic;color:var(--accent3);}
.two-col{display:grid;grid-template-columns:1fr 1fr;gap:2rem;}
@keyframes fadeUp{from{opacity:0;transform:translateY(20px);}to{opacity:1;transform:translateY(0);}}

/* ── BG GRADIENTS ── */
.bg-g1{background:linear-gradient(135deg,#1a0a2e,#2a0060);}
.bg-g2{background:linear-gradient(135deg,#0a1a2e,#004060);}
.bg-g3{background:linear-gradient(135deg,#0a2e0a,#006020);}
.bg-g4{background:linear-gradient(135deg,#2e0a0a,#600010);}
.bg-g5{background:linear-gradient(135deg,#2e2a0a,#604010);}
.bg-g6{background:linear-gradient(135deg,#0a2e2e,#006060);}

/* ── RESPONSIVE ── */
@media(max-width:900px){
  .nav-links{display:none;}
  .hamburger{display:flex;}
  .nav-right .search-wrap,.nav-right .btn-outline{display:none;}
  .search-bar{width:160px;}
  .search-bar:focus{width:200px;}
  .hero-content{flex-direction:column;gap:2rem;padding:2.5rem 1.5rem;}
  .hero-featured{flex:none;width:100%;max-width:380px;}
  .two-col{grid-template-columns:1fr;}
  .section{padding:2rem 1rem;}
}
@media(max-width:600px){
  .hero-title{font-size:clamp(42px,12vw,60px);}
  .games-grid{grid-template-columns:repeat(auto-fill,minmax(160px,1fr));}
  .reviews-grid{grid-template-columns:1fr;}
  .consoles-grid{grid-template-columns:repeat(2,1fr);}
  .nav-inner{padding:0 1rem;}
  .modal{padding:1.5rem;}
}
</style>
</head>
<body>

<nav>
  <div class="nav-inner">
    <div class="logo" onclick="window.scrollTo({top:0,behavior:'smooth'})">NEXUS<span>REVIEW</span></div>
    <div class="nav-links">
      <a href="#trending">Trending</a>
      <a href="#games">Games</a>
      <a href="#charts">Top Charts</a>
      <a href="news.php">News</a>
      <a href="#reviews">Reviews</a>
      <a href="#consoles">Consoles</a>
    </div>
    <div class="nav-right">
      <div class="search-wrap">
        <span class="search-icon">⌕</span>
        <input class="search-bar" type="text" placeholder="Search games..." id="search-input" autocomplete="off" spellcheck="false">
        <button class="search-clear" id="search-clear" onclick="clearSearch()">×</button>
        <div class="search-dropdown" id="search-dropdown"></div>
      </div>
      <button class="btn btn-outline" onclick="openAuthModal('login')">Log In</button>
      <button class="btn btn-accent" onclick="openAuthModal('signup')">Sign Up</button>
      <button class="hamburger" onclick="toggleMenu()" aria-label="Menu">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>
</nav>

<div class="mobile-menu" id="mobile-menu">
  <a href="#games" onclick="toggleMenu()">Games</a>
  <a href="#trending" onclick="toggleMenu()">Trending</a>
  <a href="news.php">News</a>
  <a href="#reviews" onclick="toggleMenu()">Reviews</a>
  <a href="#charts" onclick="toggleMenu()">Top Charts</a>
  <a href="#consoles" onclick="toggleMenu()">Consoles</a>
  <div class="mobile-menu-actions">
    <button class="btn btn-outline" style="flex:1" onclick="openAuthModal('login');toggleMenu()">Log In</button>
    <button class="btn btn-accent" style="flex:1" onclick="openAuthModal('signup');toggleMenu()">Sign Up</button>
  </div>
</div>

<div class="modal-overlay" id="auth-modal">
  <div class="modal">
    <button class="modal-close" onclick="closeModal('auth-modal')">✕</button>
    <h2 id="auth-title">WELCOME BACK</h2>
    <p class="modal-desc" id="auth-sub">Sign in to your account</p>
    <div class="modal-tabs">
      <button class="modal-tab active" onclick="switchAuthTab('login')">Log In</button>
      <button class="modal-tab" onclick="switchAuthTab('signup')">Sign Up</button>
    </div>
    <div class="form-group"><label>Email</label><input type="email" placeholder="you@example.com"></div>
    <div class="form-group"><label>Password</label><input type="password" placeholder="••••••••"></div>
    <div class="form-group" id="signup-username" style="display:none"><label>Username</label><input type="text" placeholder="GamerTag_123"></div>
    <p id="auth-error" style="color:var(--accent2);font-size:12px;margin-bottom:8px;min-height:16px;"></p>
    <button class="btn btn-accent" style="width:100%;padding:12px;font-size:14px;" id="auth-btn" onclick="handleAuth()">LOG IN</button>
    <p style="text-align:center;font-size:12px;color:var(--muted);margin-top:1rem;">Forgot password? <a href="#" style="color:var(--accent);">Reset</a></p>
  </div>
</div>

<div class="modal-overlay" id="review-modal">
  <div class="modal">
    <button class="modal-close" onclick="closeModal('review-modal')">✕</button>
    <h2>WRITE REVIEW</h2>
    <p class="modal-desc" id="review-game-name" style="color:var(--accent);font-size:15px;font-weight:600;"></p>
    <div class="form-group">
      <label>Score — <span id="score-desc-label">Select a score</span></label>
      <div class="score-slider-wrap">
        <input type="range" class="score-slider" id="review-score-slider" min="1" max="100" value="50" oninput="updateScoreSlider(this.value)">
        <div>
          <div class="score-display" id="score-display">50</div>
          <div class="score-desc" id="score-desc">Good</div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label>Your Review</label>
      <textarea placeholder="Share your thoughts about this game..." id="review-text"></textarea>
    </div>
    <div class="form-group">
      <label>Platform Played On</label>
      <select id="review-platform">
        <option value="">Select platform...</option>
        <option>PlayStation 5</option><option>PlayStation 4</option>
        <option>Xbox Series X</option><option>PC</option>
        <option>Nintendo Switch</option><option>Mobile</option>
      </select>
    </div>
    <p id="review-error" style="color:var(--accent2);font-size:12px;margin-bottom:8px;min-height:16px;"></p>
    <button class="btn btn-accent" id="submit-review-btn" style="width:100%;padding:12px;font-size:14px;" onclick="submitReview()">SUBMIT REVIEW</button>
  </div>
</div>

<div id="toast">✓ Review submitted!</div>

<section class="hero">
  <div class="hero-bg"></div>
  <div class="hero-grid"></div>
  <div class="hero-content">
    <div class="hero-text">
      <div class="hero-tag">⚡ Your ultimate gaming companion</div>
      <h1 class="hero-title">GAME<br><span class="line2">REVIEWS</span></h1>
      <p class="hero-desc">Discover, rate, and discuss the best games across every platform. Community-driven scores you can trust.</p>
      <div class="hero-actions">
        <button class="btn btn-accent" style="padding:12px 28px;font-size:15px;" onclick="document.getElementById('games').scrollIntoView({behavior:'smooth'})">Explore Games</button>
        <a href="news.php" class="btn btn-outline" style="padding:12px 28px;font-size:15px;">Latest News</a>
      </div>
      <div class="hero-stats">
        <div><div class="hero-stat-num">12K+</div><div class="hero-stat-label">Games</div></div>
        <div><div class="hero-stat-num">84K+</div><div class="hero-stat-label">Reviews</div></div>
        <div><div class="hero-stat-num">31K+</div><div class="hero-stat-label">Members</div></div>
      </div>
    </div>
    <div class="hero-featured">
      <div style="font-family:var(--font-cond);font-size:11px;font-weight:600;letter-spacing:2px;text-transform:uppercase;color:var(--muted);margin-bottom:8px;">Featured This Week</div>
      <div class="featured-card">
        <div class="featured-img bg-g1">
          <img src="images/The Witcher 4.jpg" alt="The Witcher 4" onerror="this.outerHTML='<div class=\'img-fallback\'>🧙</div>'">
          <div class="featured-badge">MUST PLAY</div>
        </div>
        <div class="featured-body">
          <h3>The Witcher 4</h3>
          <p>Action RPG · CD Projekt RED · 2025</p>
          <div style="display:flex;align-items:baseline;gap:8px;">
            <div class="score-big" id="featured-score">97</div>
            <div class="score-label" id="featured-reviews">/100 · 4,210 reviews</div>
          </div>
          <div style="display:flex;gap:6px;margin-top:8px;flex-wrap:wrap;">
            <span class="console-badge ps">PS5</span>
            <span class="console-badge xbox">Xbox</span>
            <span class="console-badge pc">PC</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section" id="trending" style="padding-bottom:0;">
  <div class="section-header">
    <div class="section-title">🔥 <span>Trending</span> Now</div>
    <div class="section-sub">Updated hourly</div>
  </div>
  <div class="trending-row">
    <div class="trending-card"><div class="trend-img bg-g1"><img src="images/Dying Light 3.jpg" onerror="this.outerHTML='<div class=\\'trend-emoji\\'>🧟</div>'"><div class="trend-rank">1</div></div><div class="trend-body"><div class="trend-title">Dying Light 3</div><div class="trend-change">↑ 240%</div></div></div>
    <div class="trending-card"><div class="trend-img bg-g2"><img src="images/Starfield 2.jpg" onerror="this.outerHTML='<div class=\\'trend-emoji\\'>🚀</div>'"><div class="trend-rank">2</div></div><div class="trend-body"><div class="trend-title">Starfield 2</div><div class="trend-change">↑ 190%</div></div></div>
    <div class="trending-card"><div class="trend-img bg-g3"><img src="images/Dragon Age 4.jpg" onerror="this.outerHTML='<div class=\\'trend-emoji\\'>⚔️</div>'"><div class="trend-rank">3</div></div><div class="trend-body"><div class="trend-title">Dragon Age 4</div><div class="trend-change">↑ 150%</div></div></div>
    <div class="trending-card"><div class="trend-img bg-g4"><img src="images/Halo Infinite 2.jpg" onerror="this.outerHTML='<div class=\\'trend-emoji\\'>🔫</div>'"><div class="trend-rank">4</div></div><div class="trend-body"><div class="trend-title">Halo Infinite 2</div><div class="trend-change down">↓ 12%</div></div></div>
    <div class="trending-card"><div class="trend-img bg-g5"><img src="images/Gran Turismo 9.jpg" onerror="this.outerHTML='<div class=\\'trend-emoji\\'>🏎️</div>'"><div class="trend-rank">5</div></div><div class="trend-body"><div class="trend-title">Gran Turismo 9</div><div class="trend-change">↑ 88%</div></div></div>
    <div class="trending-card"><div class="trend-img bg-g6"><img src="images/The Witcher 4.jpg" onerror="this.outerHTML='<div class=\\'trend-emoji\\'>🧙</div>'"><div class="trend-rank">6</div></div><div class="trend-body"><div class="trend-title">Witcher 4</div><div class="trend-change">↑ 320%</div></div></div>
    <div class="trending-card"><div class="trend-img bg-g1"><img src="images/Marvel Rivals.jpg" onerror="this.outerHTML='<div class=\\'trend-emoji\\'>🦸</div>'"><div class="trend-rank">7</div></div><div class="trend-body"><div class="trend-title">Marvel Rivals</div><div class="trend-change">↑ 75%</div></div></div>
    <div class="trending-card"><div class="trend-img bg-g2"><img src="images/Subnautica 3.jpg" onerror="this.outerHTML='<div class=\\'trend-emoji\\'>🌊</div>'"><div class="trend-rank">8</div></div><div class="trend-body"><div class="trend-title">Subnautica 3</div><div class="trend-change down">↓ 5%</div></div></div>
  </div>
</section>

<section class="section" id="games">
  <div class="section-header">
    <div class="section-title">🎮 <span>Games</span></div>
    <div class="section-sub" id="results-count"></div>
  </div>
  <div class="filter-label">Genre</div>
  <div class="filter-bar" id="genre-filter">
    <div class="filter-chip active" onclick="setFilter('genre','All',this)">All</div>
    <div class="filter-chip" onclick="setFilter('genre','Action RPG',this)">Action RPG</div>
    <div class="filter-chip" onclick="setFilter('genre','FPS',this)">FPS</div>
    <div class="filter-chip" onclick="setFilter('genre','Strategy',this)">Strategy</div>
    <div class="filter-chip" onclick="setFilter('genre','Sports',this)">Sports</div>
    <div class="filter-chip" onclick="setFilter('genre','Horror',this)">Horror</div>
    <div class="filter-chip" onclick="setFilter('genre','Adventure',this)">Adventure</div>
    <div class="filter-chip" onclick="setFilter('genre','Fighting',this)">Fighting</div>
    <div class="filter-chip" onclick="setFilter('genre','Racing',this)">Racing</div>
    <div class="filter-chip" onclick="setFilter('genre','Simulation',this)">Simulation</div>
  </div>
  <div class="filter-label">Console</div>
  <div class="filter-bar" id="console-filter" style="margin-bottom:2rem;">
    <div class="filter-chip active" onclick="setFilter('console','All',this)">All</div>
    <div class="filter-chip" onclick="setFilter('console','PS5',this)">PlayStation 5</div>
    <div class="filter-chip" onclick="setFilter('console','Xbox',this)">Xbox Series X</div>
    <div class="filter-chip" onclick="setFilter('console','PC',this)">PC</div>
    <div class="filter-chip" onclick="setFilter('console','Switch',this)">Nintendo Switch</div>
    <div class="filter-chip" onclick="setFilter('console','PS4',this)">PlayStation 4</div>
    <div class="filter-chip" onclick="setFilter('console','Mobile',this)">Mobile</div>
  </div>
  
  <div class="games-grid" id="games-grid"></div>
  
  <div id="load-more-container" style="text-align:center; margin-top:2.5rem; display:none;">
    <button class="btn btn-outline" style="padding:12px 32px; font-size:14px;" onclick="loadMoreGames()">Load More Games ↓</button>
  </div>
</section>

<div style="max-width:1400px;margin:0 auto;padding:0 1.5rem 3rem;">
  <div class="two-col">

    <div id="charts">
      <div class="section-header"><div class="section-title">🏆 Top <span>Charts</span></div></div>
      <div class="chart-list" id="dynamic-charts"></div>
    </div>

    <div id="news">
      <div class="section-header">
        <div class="section-title">📰 <span>News</span></div>
        <a href="news.php" class="section-sub" style="color:var(--accent3);">All news →</a>
      </div>
      <div style="display:flex;flex-direction:column;gap:10px;">
        <a class="news-main" href="news.php#ps6">
          <div class="news-img bg-g2">
            <img src="images/ps6-news.jpg" alt="📡 PlayStation 6" onerror="this.outerHTML='<div class=\\'img-emoji\\'>📡</div>'">
          </div>
          <div class="news-body">
            <div class="news-cat">Industry</div>
            <h3>PlayStation 6 Officially Announced</h3>
            <p>Sony confirms PS6 for late 2026 with 8K support and new DualSense Edge 2.</p>
            <div style="font-size:11px;color:var(--muted);margin-top:6px;">April 29, 2026 · 5 min read</div>
          </div>
        </a>
        <a class="news-mini" href="news.php#fortnite">
          <div class="news-mini-img bg-g1">
            <img src="images/fortnite-update.jpg" alt="🎮 Fortnite" onerror="this.outerHTML='🎮'">
          </div>
          <div><div class="news-mini-cat">Update</div><div class="news-mini-title">Fortnite Chapter 6 adds new weapons and biomes</div><div class="news-date">April 28</div></div>
        </a>
        <a class="news-mini" href="news.php#worlds">
          <div class="news-mini-img bg-g3">
            <img src="images/worlds-egypt.jpg" alt="🏆 Esports" onerror="this.outerHTML='🏆'">
          </div>
          <div><div class="news-mini-cat">Esports</div><div class="news-mini-title">Worlds 2026 — Egypt to host the finals</div><div class="news-date">April 27</div></div>
        </a>
        <a class="news-mini" href="news.php#witcher-review">
          <div class="news-mini-img bg-g6">
            <img src="images/witcher-review.jpg" alt="🔥 Review" onerror="this.outerHTML='🔥'">
          </div>
          <div><div class="news-mini-cat">Review</div><div class="news-mini-title">Witcher 4: CDPR's most ambitious game yet</div><div class="news-date">April 26</div></div>
        </a>
      </div>
    </div>

  </div>
</div>

<section class="section" id="reviews" style="padding-top:1rem;">
  <div class="section-header">
    <div class="section-title">💬 Community <span>Reviews</span></div>
  </div>
  <div class="reviews-grid" id="reviews-grid">
  </div>
</section>

<section class="section" id="consoles">
  <div class="section-header"><div class="section-title">🕹️ Browse by <span>Console</span></div></div>
  <div class="consoles-grid">
    <div class="console-card ps-card" onclick="jumpToFilter('PS5')"><div class="console-icon">🎮</div><div class="console-name">PlayStation 5</div><div class="console-count">3,420 games</div></div>
    <div class="console-card xbox-card" onclick="jumpToFilter('Xbox')"><div class="console-icon">🟢</div><div class="console-name">Xbox Series X</div><div class="console-count">2,890 games</div></div>
    <div class="console-card pc-card" onclick="jumpToFilter('PC')"><div class="console-icon">💻</div><div class="console-name">PC</div><div class="console-count">8,200 games</div></div>
    <div class="console-card switch-card" onclick="jumpToFilter('Switch')"><div class="console-icon">🔴</div><div class="console-name">Nintendo Switch</div><div class="console-count">4,100 games</div></div>
    <div class="console-card ps4-card" onclick="jumpToFilter('PS4')"><div class="console-icon">📀</div><div class="console-name">PlayStation 4</div><div class="console-count">5,600 games</div></div>
    <div class="console-card mobile-card" onclick="jumpToFilter('Mobile')"><div class="console-icon">📱</div><div class="console-name">Mobile</div><div class="console-count">12,000 games</div></div>
  </div>
</section>

<footer class="site-footer">
  <div class="footer-accent-bar"></div>
  <div class="footer-inner">

    <div class="footer-top">

      <div class="footer-brand-col">
        <div class="footer-brand-logo" onclick="window.scrollTo({top:0,behavior:'smooth'})">NEXUS<span>REVIEW</span></div>
        <p class="footer-tagline">Your definitive source for game reviews, news, and rankings — written by gamers, for gamers.</p>
        <div class="footer-socials">
          <a class="footer-social-btn" href="#" title="Facebook">
            <svg viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
          </a>
          <a class="footer-social-btn" href="#" title="Twitter/X">
            <svg viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
          </a>
          <a class="footer-social-btn" href="#" title="Instagram">
            <svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" style="fill:var(--bg2)"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5" style="stroke:var(--bg2);stroke-width:2;stroke-linecap:round"/></svg>
          </a>
          <a class="footer-social-btn" href="#" title="YouTube">
            <svg viewBox="0 0 24 24"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46a2.78 2.78 0 0 0-1.95 1.96A29 29 0 0 0 1 12a29 29 0 0 0 .46 5.58A2.78 2.78 0 0 0 3.41 19.6C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 0 0 1.95-1.95A29 29 0 0 0 23 12a29 29 0 0 0-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" style="fill:var(--bg2)"/></svg>
          </a>
        </div>
      </div>

      <div class="footer-nav-col">
        <h4>Navigate</h4>
        <ul>
          <li><a href="#trending">Trending</a></li>
          <li><a href="#games">All Games</a></li>
          <li><a href="#charts">Top Charts</a></li>
          <li><a href="news.php">News</a></li>
          <li><a href="#reviews">Reviews</a></li>
          <li><a href="#consoles">Consoles</a></li>
        </ul>
      </div>

      <div class="footer-nav-col">
        <h4>Company</h4>
        <ul>
          <li><a href="javascript:void(0)">About Us</a></li>
          <li><a href="javascript:void(0)">Help Center</a></li>
          <li><a href="javascript:void(0)">Careers</a></li>
          <li><a href="javascript:void(0)">Advertise</a></li>
          <li><a href="javascript:void(0)">Press Kit</a></li>
        </ul>
      </div>

      <div class="footer-nav-col">
        <h4>Legal</h4>
        <ul>
          <li><a href="javascript:void(0)">Privacy Policy</a></li>
          <li><a href="javascript:void(0)">Terms of Use</a></li>
          <li><a href="javascript:void(0)">Cookie Policy</a></li>
          <li><a href="javascript:void(0)">Accessibility</a></li>
          <li><a href="javascript:void(0)">Contact Us</a></li>
        </ul>
      </div>

    </div><div class="footer-bottom">
      <p class="footer-copy">&copy; 2026 <span>NexusReview</span> — All rights reserved.</p>
      <div class="footer-brands">
        <span class="footer-brands-label">Part of</span>
        <span class="footer-brand-tag">GAMESPOT</span>
        <span class="footer-brand-tag tag-box">TV GUIDE</span>
        <span class="footer-brand-tag tag-italic">GAMEFAQS</span>
      </div>
    </div>

  </div>
</footer>

<script>
// ══════════════════════════════════════════════════════════════
//  NexusReview — API-connected frontend
//  API base: /nexusreview/api/
// ══════════════════════════════════════════════════════════════

const API = '/nexusreview/api';

function scoresToStars(s){return s>=90?'★★★★★':s>=70?'★★★★☆':s>=50?'★★★☆☆':s>=30?'★★☆☆☆':'★☆☆☆☆';}

const consoleBadgeClass = {PS5:'ps',Xbox:'xbox',PC:'pc',Switch:'switch',Mobile:'mobile-badge',PS4:'ps4'};

// ── APP STATE ─────────────────────────────────────────────────
let GAMES = [];           // loaded from API
let activeGenre   = 'All';
let activeConsole = 'All';
let activeSearch  = '';
let currentUser   = null; // set after login

let visibleGamesCount = 6;
let currentFilteredList = [];
let currentSearchQuery = '';

// ── SESSION RESTORE ───────────────────────────────────────────
// Keep logged-in user across page reloads using localStorage
(function restoreSession(){
  const saved = localStorage.getItem('nx_user');
  if(saved){ try{ currentUser = JSON.parse(saved); updateNavForUser(); }catch(e){} }
})();

function updateNavForUser(){
  if(!currentUser) return;
  const logBtn  = document.querySelector('.btn-outline');
  const signBtn = document.querySelector('.btn-accent');
  if(logBtn)  { logBtn.textContent  = currentUser.username; logBtn.onclick = null; }
  if(signBtn) { signBtn.textContent = 'Log Out'; signBtn.onclick = logOut; }
}

// ══════════════════════════════════════════════════════════════
//  API CALLS
// ══════════════════════════════════════════════════════════════

async function apiGet(endpoint){
  const res = await fetch(API + endpoint);
  if(!res.ok) throw new Error('API error ' + res.status);
  return res.json();
}

async function apiPost(endpoint, body){
  const res = await fetch(API + endpoint, {
    method: 'POST',
    headers: {'Content-Type':'application/json'},
    body: JSON.stringify(body)
  });
  return res.json();
}

// ── LOAD GAMES FROM DATABASE ──────────────────────────────────
async function loadGames(){
  showGridLoading();
  try {
    const data = await apiGet('/games.php');
    GAMES = data.games || [];
    applyFilters();
    updateDynamicSections();
  } catch(e) {
    document.getElementById('games-grid').innerHTML =
      '<div class="no-results"><div class="no-results-icon">⚠️</div><p>Could not load games. Is XAMPP running?</p></div>';
  }
}

function showGridLoading(){
  document.getElementById('games-grid').innerHTML =
    Array(8).fill(`<div class="game-card" style="opacity:.3;pointer-events:none;">
      <div class="game-thumb bg-g1" style="height:130px;"></div>
      <div class="game-body"><div style="height:14px;background:var(--border);border-radius:4px;margin-bottom:8px;"></div>
      <div style="height:11px;background:var(--border);border-radius:4px;width:60%;"></div></div></div>`).join('');
}

// ── DYNAMIC SECTIONS (Top Charts & Featured) ──────────────────
function updateDynamicSections() {
  // 1. Update Featured Game
  const featuredGame = GAMES.find(g => g.title === 'The Witcher 4');
  if (featuredGame) {
    const fScore = document.getElementById('featured-score');
    const fRevs = document.getElementById('featured-reviews');
    if(fScore) fScore.textContent = featuredGame.avg_score || '—';
    if(fRevs) fRevs.textContent = `/100 · ${featuredGame.review_count || 0} reviews`;
  }

  // 2. Update Top Charts
  const topGames = [...GAMES].sort((a, b) => (b.avg_score || 0) - (a.avg_score || 0)).slice(0, 6);
  const chartsContainer = document.getElementById('dynamic-charts');
  
  if (chartsContainer) {
    chartsContainer.innerHTML = topGames.map((g, index) => {
      const rank = index + 1;
      const topClass = rank <= 3 ? 'top3' : '';
      const gameIcon = g.icon || '🎮';
      const gameBg = g.bg_class || 'bg-g1';
      const score = g.avg_score || '—';
      const reviews = g.review_count || 0;
      
      const thumbHtml = g.cover_image 
        ? `<img src="${g.cover_image}" alt="${g.title}" onerror="this.outerHTML='<span>${gameIcon}</span>'">`
        : `<span>${gameIcon}</span>`;

      return `<div class="chart-item" onclick="selectGame(${g.id})">
        <div class="chart-rank ${topClass}">${rank}</div>
        <div class="chart-thumb ${gameBg}">
          ${thumbHtml}
        </div>
        <div class="chart-info">
          <div class="chart-name">${g.title}</div>
          <div class="chart-detail">${g.genre} · ${reviews} reviews</div>
        </div>
        <div class="chart-score">${score}</div>
      </div>`;
    }).join('');
  }
}

// ── LOAD REVIEWS FROM DATABASE ────────────────────────────────
async function loadReviews(){
  try {
    const data = await apiGet(`/reviews.php`);
    const allReviews = data.reviews || [];
    
    if(allReviews.length) {
      renderReviewCards(allReviews);
    }
  } catch(e) { 
    console.error("Could not load community reviews", e);
  }
}

function renderReviewCards(reviews){
  const grid = document.getElementById('reviews-grid');
  const colors=[['#1a0a2e','#b59eff'],['#0a1a0a','#50c878'],['#2e0a0a','#ff9a99'],['#0a1a2e','#7ab8ff']];
  grid.innerHTML = reviews.slice(0,8).map(r => {
    const c = colors[r.id % colors.length];
    const initials = r.username ? r.username.slice(0,2).toUpperCase() : 'AN';
    const stars = scoresToStars(r.score);
    const gameTitle = GAMES.find(g=>g.id===r.game_id)?.title || 'Unknown Game';
    const date = new Date(r.created_at).toLocaleDateString('en-US',{month:'short',day:'numeric',year:'numeric'});
    return `<div class="review-card">
      <div class="review-header">
        <div class="avatar" style="background:${c[0]};color:${c[1]};">${initials}</div>
        <div><div class="review-user">${r.username}</div><div class="review-date">${date}</div></div>
        <div style="margin-left:auto;"><span class="score-pill">${r.score}</span></div>
      </div>
      <div class="review-game">${gameTitle}</div>
      <div class="review-text">${r.body}</div>
      <div class="review-footer"><div class="stars">${stars}</div><span class="helpful">👍 ${r.helpful} helpful</span></div>
    </div>`;
  }).join('');
}

// ══════════════════════════════════════════════════════════════
//  FUZZY SEARCH (works on loaded GAMES array)
// ══════════════════════════════════════════════════════════════
function fuzzyScore(q,t){
  const ql=q.toLowerCase(),tl=t.toLowerCase();
  if(tl.includes(ql)) return 100+(ql.length/tl.length)*50;
  let qi=0,score=0,last=-1;
  for(let i=0;i<tl.length&&qi<ql.length;i++){
    if(tl[i]===ql[qi]){score+=last===i-1?10:3;last=i;qi++;}
  }
  return qi===ql.length?score:0;
}
function scoreGame(q,g){
  if(!q)return 1;
  const devName = g.developer || g.dev || '';
  return Math.max(fuzzyScore(q,g.title)*3, fuzzyScore(q,devName)*1.5, fuzzyScore(q,g.genre)*1.2,
    ...(g.consoles||[]).map(c=>fuzzyScore(q,c)));
}
function highlight(text,query){
  if(!query)return text;
  const idx=text.toLowerCase().indexOf(query.toLowerCase());
  if(idx!==-1) return text.slice(0,idx)+'<mark>'+text.slice(idx,idx+query.length)+'</mark>'+text.slice(idx+query.length);
  let r='',qi=0,ql=query.toLowerCase();
  for(let i=0;i<text.length;i++){
    if(qi<ql.length&&text[i].toLowerCase()===ql[qi]){r+='<mark>'+text[i]+'</mark>';qi++;}
    else r+=text[i];
  }
  return r;
}

// ── SEARCH DROPDOWN ───────────────────────────────────────────
let focusedIdx=-1;
const searchInput    = document.getElementById('search-input');
const searchDropdown = document.getElementById('search-dropdown');
const searchClearBtn = document.getElementById('search-clear');

searchInput.addEventListener('input',()=>{
  activeSearch=searchInput.value.trim();
  searchClearBtn.style.display=activeSearch?'block':'none';
  focusedIdx=-1; renderDropdown(activeSearch); applyFilters();
});
searchInput.addEventListener('keydown',e=>{
  const items=searchDropdown.querySelectorAll('.search-item');
  if(e.key==='ArrowDown'){e.preventDefault();focusedIdx=Math.min(focusedIdx+1,items.length-1);updateFocus(items);}
  else if(e.key==='ArrowUp'){e.preventDefault();focusedIdx=Math.max(focusedIdx-1,-1);updateFocus(items);}
  else if(e.key==='Enter'){if(focusedIdx>=0&&items[focusedIdx])items[focusedIdx].click();else{closeDropdown();document.getElementById('games').scrollIntoView({behavior:'smooth'});}}
  else if(e.key==='Escape')clearSearch();
});
searchInput.addEventListener('focus',()=>{if(activeSearch)renderDropdown(activeSearch);});
function updateFocus(items){items.forEach((el,i)=>el.classList.toggle('focused',i===focusedIdx));if(items[focusedIdx])items[focusedIdx].scrollIntoView({block:'nearest'});}

function renderDropdown(query){
  if(!query){closeDropdown();return;}
  const scored=GAMES.map(g=>({g,s:scoreGame(query,g)})).filter(x=>x.s>0).sort((a,b)=>b.s-a.s).slice(0,6);
  if(!scored.length){
    searchDropdown.innerHTML=`<div class="search-no-results">No games found for "<strong>${query}</strong>"</div>`;
    searchDropdown.classList.add('open');return;
  }
  let html='<div class="search-section-label">Games</div>';
  scored.forEach(({g})=>{
    const gameIcon = g.icon || '🎮';
    const gameBg = g.bg_class || 'bg-g1';
    const score = g.avg_score || g.score || '—';

    const searchThumbHtml = g.cover_image 
      ? `<img src="${g.cover_image}" onerror="this.outerHTML='<span>${gameIcon}</span>'">` 
      : `<span>${gameIcon}</span>`;

    html+=`<div class="search-item" onclick="selectGame(${g.id})">
      <div class="search-item-icon ${gameBg}">${searchThumbHtml}</div>
      <div class="search-item-info">
        <div class="search-item-title">${highlight(g.title,query)}</div>
        <div class="search-item-meta">${g.genre} · ${g.developer||g.dev} · ${(g.consoles||[]).join(', ')}</div>
      </div>
      <div class="search-item-score">${score}</div>
    </div>`;
  });
  const genreMatches=[...new Set(GAMES.map(g=>g.genre))].filter(gn=>gn.toLowerCase().includes(query.toLowerCase()));
  if(genreMatches.length){
    html+='<div class="search-section-label" style="margin-top:4px;">Genres</div>';
    genreMatches.slice(0,3).forEach(gn=>{
      const count=GAMES.filter(g=>g.genre===gn).length;
      html+=`<div class="search-item" onclick="filterByGenre('${gn}')"><div class="search-item-icon">🎯</div><div class="search-item-info"><div class="search-item-title">${highlight(gn,query)}</div><div class="search-item-meta">${count} games</div></div></div>`;
    });
  }
  html+=`<div class="search-footer"><span>↑↓ navigate</span><span><kbd>Enter</kbd> search · <kbd>Esc</kbd> clear</span></div>`;
  searchDropdown.innerHTML=html; searchDropdown.classList.add('open');
}
function selectGame(id){
  const g=GAMES.find(x=>x.id===id);if(!g)return;
  searchInput.value=g.title;activeSearch=g.title;closeDropdown();
  activeGenre='All';activeConsole='All';
  document.querySelectorAll('#genre-filter .filter-chip').forEach((c,i)=>c.classList.toggle('active',i===0));
  document.querySelectorAll('#console-filter .filter-chip').forEach((c,i)=>c.classList.toggle('active',i===0));
  applyFilters(); document.getElementById('games').scrollIntoView({behavior:'smooth'});
}
function filterByGenre(genre){
  activeGenre=genre;activeSearch='';searchInput.value='';searchClearBtn.style.display='none';closeDropdown();
  document.querySelectorAll('#genre-filter .filter-chip').forEach(c=>c.classList.toggle('active',c.textContent===genre));
  applyFilters(); document.getElementById('games').scrollIntoView({behavior:'smooth'});
}
function clearSearch(){searchInput.value='';activeSearch='';searchClearBtn.style.display='none';closeDropdown();applyFilters();searchInput.focus();}
function closeDropdown(){searchDropdown.classList.remove('open');focusedIdx=-1;}
document.addEventListener('click',e=>{if(!e.target.closest('.search-wrap'))closeDropdown();});

// ── RENDER GAMES GRID ─────────────────────────────────────────
function renderGames(list, query) {
  currentFilteredList = list;
  currentSearchQuery = query;
  renderGamesGrid();
}

function renderGamesGrid() {
  const grid = document.getElementById('games-grid');
  const loadMoreBtn = document.getElementById('load-more-container');

  if (!currentFilteredList.length) {
    grid.innerHTML = '<div class="no-results"><div class="no-results-icon">🔍</div><p>No games match your filters.</p></div>';
    document.getElementById('results-count').textContent = '0 games';
    if (loadMoreBtn) loadMoreBtn.style.display = 'none';
    return;
  }
  
  document.getElementById('results-count').textContent = currentFilteredList.length + ' game' + (currentFilteredList.length !== 1 ? 's' : '');
  
  const visibleList = currentFilteredList.slice(0, visibleGamesCount);
  
  grid.innerHTML = visibleList.map(g => {
    const gameIcon = g.icon || '🎮';
    const gameBg = g.bg_class || 'bg-g1';
    const score  = g.avg_score || g.score || '—';
    const stars  = scoresToStars(parseInt(score)||0);
    const badges = (g.consoles||[]).map(c=>`<span class="console-badge ${consoleBadgeClass[c]||'ps'}">${c}</span>`).join('');
    const titleHtml = currentSearchQuery ? highlight(g.title, currentSearchQuery) : g.title;
    
    const thumbHtml = g.cover_image 
      ? `<img src="${g.cover_image}" alt="${g.title}" onerror="this.outerHTML='<div class=\\'thumb-fallback\\'>${gameIcon}</div>'">`
      : `<div class="thumb-fallback">${gameIcon}</div>`;

    return `<div class="game-card">
      <div class="game-thumb ${gameBg}">
        ${thumbHtml}
        <div class="game-thumb-label">${score}</div>
      </div>
      <div class="game-body">
        <div class="game-title">${titleHtml}</div>
        <div class="game-genre">${g.genre}</div>
        <div class="game-footer"><span class="stars">${stars}</span><span class="score-pill">${score}</span></div>
        <div class="console-tags">${badges}</div>
        <button class="btn-review" onclick="openReviewModal('${g.title.replace(/'/g,"\\'")}',${g.id})">+ Write a Review</button>
      </div>
    </div>`;
  }).join('');

  if (currentFilteredList.length > visibleGamesCount) {
    if (loadMoreBtn) loadMoreBtn.style.display = 'block';
  } else {
    if (loadMoreBtn) loadMoreBtn.style.display = 'none';
  }
}

function loadMoreGames() {
  visibleGamesCount += 5;
  renderGamesGrid();
}

// ── FILTERS ───────────────────────────────────────────────────
function applyFilters(){
  const q=activeSearch.toLowerCase();
  let filtered=GAMES.filter(g=>{
    const mG=activeGenre==='All'||g.genre===activeGenre;
    const mC=activeConsole==='All'||(g.consoles||[]).includes(activeConsole);
    const mS=!q||scoreGame(q,g)>0;
    return mG&&mC&&mS;
  });
  if(q) filtered=filtered.sort((a,b)=>scoreGame(q,b)-scoreGame(q,a));
  
  visibleGamesCount = 10;
  
  renderGames(filtered,activeSearch);
}

function setFilter(type,value,el){
  if(type==='genre'){
    activeGenre=value;
    document.querySelectorAll('#genre-filter .filter-chip').forEach(c=>c.classList.remove('active'));
    if(el)el.classList.add('active');
  }else{
    activeConsole=value;
    document.querySelectorAll('#console-filter .filter-chip').forEach(c=>c.classList.remove('active'));
    if(el)el.classList.add('active');
    else{
      document.querySelectorAll('#console-filter .filter-chip').forEach(c=>{
        const map={'All':'All','PlayStation 5':'PS5','Xbox Series X':'Xbox','PC':'PC','Nintendo Switch':'Switch','PlayStation 4':'PS4','Mobile':'Mobile'};
        if(map[c.textContent]===value)c.classList.add('active');
      });
    }
  }
  applyFilters();
}
function jumpToFilter(con){setFilter('console',con,null);document.getElementById('games').scrollIntoView({behavior:'smooth'});}

// ── HAMBURGER ─────────────────────────────────────────────────
function toggleMenu(){document.getElementById('mobile-menu').classList.toggle('open');}

// ══════════════════════════════════════════════════════════════
//  AUTH — connected to /api/auth.php
// ══════════════════════════════════════════════════════════════
function openAuthModal(tab){document.getElementById('auth-modal').classList.add('open');switchAuthTab(tab);}
function switchAuthTab(tab){
  document.querySelectorAll('.modal-tab').forEach((t,i)=>t.classList.toggle('active',(i===0&&tab==='login')||(i===1&&tab==='signup')));
  document.getElementById('signup-username').style.display=tab==='signup'?'block':'none';
  document.getElementById('auth-btn').textContent=tab==='login'?'LOG IN':'CREATE ACCOUNT';
  document.getElementById('auth-title').textContent=tab==='login'?'WELCOME BACK':'JOIN THE HUB';
  document.getElementById('auth-sub').textContent=tab==='login'?'Sign in to your account':'Create your free account';
  document.getElementById('auth-error').textContent='';
}

async function handleAuth(){
  const btn     = document.getElementById('auth-btn');
  const errEl   = document.getElementById('auth-error');
  const isLogin = btn.textContent==='LOG IN';
  const email   = document.querySelector('#auth-modal input[type=email]').value.trim();
  const pass    = document.querySelector('#auth-modal input[type=password]').value;
  const uname   = document.getElementById('signup-username')?.querySelector('input')?.value?.trim();

  errEl.textContent='';
  if(!email||!pass){errEl.textContent='Please fill in all fields.';return;}

  btn.textContent='...'; btn.disabled=true;

  try {
    const action = isLogin ? 'login' : 'register';
    const body   = isLogin ? {email,password:pass} : {email,password:pass,username:uname};
    const res    = await apiPost(`/auth.php?action=${action}`, body);

    if(res.error){errEl.textContent=res.error;btn.textContent=isLogin?'LOG IN':'CREATE ACCOUNT';btn.disabled=false;return;}

    currentUser = {id:res.user_id, username:res.username, role:res.role};
    localStorage.setItem('nx_user', JSON.stringify(currentUser));
    updateNavForUser();
    closeModal('auth-modal');
    showToast(`Welcome, ${currentUser.username}!`);
  } catch(e){
    errEl.textContent='Server error. Check XAMPP is running.';
    btn.textContent=isLogin?'LOG IN':'CREATE ACCOUNT'; btn.disabled=false;
  }
}

async function logOut(){
  await apiGet('/auth.php?action=logout').catch(()=>{});
  currentUser=null;
  localStorage.removeItem('nx_user');
  location.reload();
}

// ══════════════════════════════════════════════════════════════
//  REVIEWS — connected to /api/reviews.php
// ══════════════════════════════════════════════════════════════
let activeReviewGameId = null;

function openReviewModal(gameName, gameId){
  if(!currentUser){openAuthModal('login');showToast('Log in to write a review');return;}
  activeReviewGameId = gameId;
  document.getElementById('review-modal').classList.add('open');
  document.getElementById('review-game-name').textContent=gameName||'Select a game';
  document.getElementById('review-text').value='';
  document.getElementById('review-platform').value='';
  document.getElementById('review-score-slider').value=50;
  document.getElementById('review-error').textContent='';
  updateScoreSlider(50);
}

async function submitReview(){
  const text     = document.getElementById('review-text').value.trim();
  const score    = Math.round(document.getElementById('review-score-slider').value);
  const platform = document.getElementById('review-platform').value;
  const errEl    = document.getElementById('review-error');
  const btn      = document.getElementById('submit-review-btn');

  errEl.textContent='';
  if(!text){errEl.textContent='Please write your review.';return;}
  if(!currentUser){errEl.textContent='You must be logged in.';return;}

  btn.textContent='Saving...'; btn.disabled=true;

  try {
    const res = await apiPost('/reviews.php', {
      game_id: activeReviewGameId,
      user_id: currentUser.id,
      score, body: text, platform
    });

    if(res.error){errEl.textContent=res.error;btn.textContent='SUBMIT REVIEW';btn.disabled=false;return;}

    // Optimistically add to the community reviews section
    const game  = document.getElementById('review-game-name').textContent;
    const stars = scoresToStars(score);
    const colors=[['#1a0a2e','#b59eff'],['#0a1a0a','#50c878'],['#2e0a0a','#ff9a99'],['#0a1a2e','#7ab8ff']];
    const c=colors[currentUser.id%colors.length];
    const initials=currentUser.username.slice(0,2).toUpperCase();
    const card=document.createElement('div');
    card.className='review-card';
    card.innerHTML=`
      <div class="review-header"><div class="avatar" style="background:${c[0]};color:${c[1]};">${initials}</div>
      <div><div class="review-user">${currentUser.username}</div><div class="review-date">Just now</div></div>
      <div style="margin-left:auto;"><span class="score-pill">${score}</span></div></div>
      <div class="review-game">${game}</div>
      <div class="review-text">${text}</div>
      <div class="review-footer"><div class="stars">${stars}</div><span class="helpful">👍 0 helpful</span></div>`;
    document.getElementById('reviews-grid').prepend(card);

    btn.textContent='SUBMIT REVIEW'; btn.disabled=false;
    closeModal('review-modal');
    showToast('Review submitted!');
  } catch(e){
    errEl.textContent='Server error. Check XAMPP is running.';
    btn.textContent='SUBMIT REVIEW'; btn.disabled=false;
  }
}

function updateScoreSlider(val){
  val=Math.round(val);
  document.getElementById('score-display').textContent=val;
  const descs=['','Terrible','Terrible','Terrible','Terrible','Terrible','Terrible','Terrible','Terrible','Terrible','Terrible',
    'Awful','Awful','Awful','Awful','Awful','Awful','Awful','Awful','Awful','Awful',
    'Poor','Poor','Poor','Poor','Poor','Poor','Poor','Poor','Poor','Poor',
    'Below Average','Below Average','Below Average','Below Average','Below Average','Below Average','Below Average','Below Average','Below Average','Below Average',
    'Mediocre','Mediocre','Mediocre','Mediocre','Mediocre','Mediocre','Mediocre','Mediocre','Mediocre','Mediocre',
    'Average','Average','Average','Average','Average','Average','Average','Average','Average','Average',
    'Good','Good','Good','Good','Good','Good','Good','Good','Good','Good',
    'Great','Great','Great','Great','Great','Great','Great','Great','Great','Great',
    'Excellent','Excellent','Excellent','Excellent','Excellent','Excellent','Excellent','Excellent','Excellent','Excellent',
    'Masterpiece','Masterpiece','Masterpiece','Masterpiece','Masterpiece','Masterpiece','Masterpiece','Masterpiece','Masterpiece','Masterpiece'];
  document.getElementById('score-desc').textContent=descs[val]||'';
  const pct=(val-1)/99*100;
  const color=val>=80?'#e8ff3a':val>=60?'#ff9a44':val>=40?'#ff6b6b':'#ff3a6e';
  document.getElementById('score-display').style.color=color;
  document.getElementById('review-score-slider').style.background=`linear-gradient(to right,${color} ${pct}%,var(--border) ${pct}%)`;
}

// ── MODAL HELPERS ─────────────────────────────────────────────
function closeModal(id){document.getElementById(id).classList.remove('open');}
function showToast(msg){
  const t=document.getElementById('toast');
  if(msg) t.textContent=msg;
  t.style.transform='translateY(0)';t.style.opacity='1';
  setTimeout(()=>{t.style.transform='translateY(80px)';t.style.opacity='0';},2500);
}
['auth-modal','review-modal'].forEach(id=>{
  document.getElementById(id).addEventListener('click',function(e){if(e.target===this)closeModal(id);});
});

// ══════════════════════════════════════════════════════════════
//  BOOT — load everything from the database
// ══════════════════════════════════════════════════════════════
updateScoreSlider(50);
loadGames().then(() => loadReviews());
</script>
</body>
</html>