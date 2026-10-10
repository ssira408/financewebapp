<!doctype html>
<html lang="th">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
<meta name="color-scheme" content="light dark">
<title>สมุดเงิน · บันทึกและวางแผนการเงิน</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Thai:wght@400;500;600&family=Mitr:wght@400;500&display=swap" rel="stylesheet">
<style>
:root{
  box-sizing:border-box;
  padding-top:env(safe-area-inset-top,0px);
  padding-bottom:env(safe-area-inset-bottom,0px);
  --paper:#EEF1EE; --surface:#FFFFFF; --surface-2:#F4F6F4; --ink:#17212B; --muted:#5A6672; --line:#DAE0DC;
  --primary:#2B4C9B; --primary-soft:#E3E9F8; --on-primary:#FFFFFF;
  --income:#157A55; --income-soft:#DFF1E8;
  --expense:#B93B32; --expense-soft:#F9E4E1;
  --save:#6542A3; --save-soft:#EBE4F6; --on-save:#FFFFFF;
  --warn:#9A6508; --warn-soft:#FAEFD3;
  --scrim:rgba(12,18,24,.52);
  --font:'IBM Plex Sans Thai','Noto Sans Thai','Sarabun','Loma',system-ui,-apple-system,'Segoe UI',sans-serif;
  --display:'Mitr','IBM Plex Sans Thai','Noto Sans Thai','Loma',sans-serif;
}
@media (prefers-color-scheme:dark){
  :root:not([data-theme="light"]){
    --paper:#11161B; --surface:#192027; --surface-2:#202931; --ink:#E8EDF1; --muted:#9BA8B4; --line:#2C3741;
    --primary:#86A3F2; --primary-soft:#222C47; --on-primary:#0E1836;
    --income:#4DC896; --income-soft:#173126;
    --expense:#F0827A; --expense-soft:#3A2220;
    --save:#B9A0F2; --save-soft:#2A2340; --on-save:#1B1230;
    --warn:#E3B34F; --warn-soft:#352B15;
    --scrim:rgba(0,0,0,.62);
  }
}
:root[data-theme="dark"]{
  --paper:#11161B; --surface:#192027; --surface-2:#202931; --ink:#E8EDF1; --muted:#9BA8B4; --line:#2C3741;
  --primary:#86A3F2; --primary-soft:#222C47; --on-primary:#0E1836;
  --income:#4DC896; --income-soft:#173126;
  --expense:#F0827A; --expense-soft:#3A2220;
  --save:#B9A0F2; --save-soft:#2A2340; --on-save:#1B1230;
  --warn:#E3B34F; --warn-soft:#352B15;
  --scrim:rgba(0,0,0,.62);
}
*,*::before,*::after{box-sizing:inherit}
html{scroll-padding-top:env(safe-area-inset-top,0px);-webkit-text-size-adjust:100%}
body{margin:0;background:var(--paper);color:var(--ink);font:400 15.5px/1.65 var(--font);-webkit-font-smoothing:antialiased}
[hidden]{display:none!important}
button{font:inherit;color:inherit}
h1,h2,h3,p{margin:0}
.num,.tab-num{font-variant-numeric:tabular-nums}
b,strong{font-weight:600}
small{font-size:13px}
.muted{color:var(--muted)}
.inc{color:var(--income)} .exp{color:var(--expense)} .sav{color:var(--save)} .wrn{color:var(--warn)}
.ic{flex:none;display:block}

/* ---------- layout ---------- */
.app{display:grid;grid-template-columns:248px minmax(0,1fr);min-height:100%}
.side{position:sticky;top:0;align-self:start;max-height:100vh;overflow:auto;padding:22px 14px 16px;display:flex;flex-direction:column;gap:3px;background:var(--surface);border-right:1px solid var(--line)}
.brand{display:flex;align-items:center;gap:11px;padding:2px 10px 18px}
.brand-mark{width:36px;height:36px;border-radius:10px 10px 10px 3px;background:var(--primary);color:var(--on-primary);display:grid;place-items:center;font:500 20px/1 var(--display)}
.brand-name{font:500 21px/1.2 var(--display)}
.brand-sub{font-size:12.5px;color:var(--muted);line-height:1.3}
.navbtn{display:flex;align-items:center;gap:12px;width:100%;text-align:left;padding:9px 12px;border-radius:9px;border:0;background:none;color:var(--muted);font-weight:500;cursor:pointer}
.navbtn:hover{background:var(--surface-2);color:var(--ink)}
.navbtn[aria-current="page"]{background:var(--primary-soft);color:var(--primary)}
.side-foot{margin-top:auto;padding:14px 10px 0;border-top:1px solid var(--line);font-size:12.5px;color:var(--muted);line-height:1.5}
.sync-dot{display:inline-block;width:8px;height:8px;border-radius:50%;background:var(--muted);margin-right:7px}
.sync-dot.cloud{background:var(--income)} .sync-dot.err{background:var(--expense)} .sync-dot.busy{background:var(--warn)}
.main{width:100%;max-width:1140px;padding:30px clamp(16px,3.6vw,44px) 70px}
.pagehead{display:flex;flex-wrap:wrap;align-items:flex-end;justify-content:space-between;gap:14px;margin-bottom:22px}
.pagehead h1{font:500 27px/1.3 var(--display)}
.pagehead p{color:var(--muted);margin-top:2px;max-width:60ch}
.head-actions{display:flex;flex-wrap:wrap;gap:10px;align-items:center}
.stack>*+*{margin-top:16px}
.grid2{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px}
.grid3{display:grid;grid-template-columns:repeat(auto-fill,minmax(290px,1fr));gap:16px}
.grid-wide{display:grid;grid-template-columns:minmax(0,1.35fr) minmax(0,1fr);gap:16px}

/* ---------- cards ---------- */
.card{background:var(--surface);border:1px solid var(--line);border-radius:14px;padding:18px 20px}
.card>h2,.card-h{font-size:16px;font-weight:600;margin-bottom:12px;display:flex;justify-content:space-between;align-items:center;gap:10px}
.card-h a,.linkbtn{font-size:13.5px;font-weight:500;color:var(--primary);background:none;border:0;cursor:pointer;padding:0}
.linkbtn:hover{text-decoration:underline}

/* ---------- controls ---------- */
.btn{display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:8px 16px;min-height:40px;border-radius:8px;border:1px solid var(--line);background:var(--surface);color:var(--ink);font-weight:500;font-size:14.5px;line-height:1.4;cursor:pointer;text-decoration:none}
.btn:hover{background:var(--surface-2)}
.btn.primary{background:var(--primary);border-color:var(--primary);color:var(--on-primary)}
.btn.primary:hover{filter:brightness(1.08)}
.btn.danger{color:var(--expense)}
.btn.ghost{border-color:transparent;background:transparent;color:var(--primary)}
.btn.sm{min-height:32px;padding:4px 11px;font-size:13.5px;border-radius:7px}
.icon-btn{display:inline-grid;place-items:center;width:36px;height:36px;border-radius:8px;border:0;background:none;color:var(--muted);cursor:pointer}
.icon-btn:hover{background:var(--surface-2);color:var(--ink)}
.icon-btn.sm{width:30px;height:30px}
:where(button,input,select,textarea,a,[tabindex]):focus-visible{outline:2px solid var(--primary);outline-offset:2px}
.btnrow{display:flex;flex-wrap:wrap;gap:8px}
.fld{display:grid;gap:5px;margin-bottom:14px}
.fld label,.fld .lbl{font-weight:500;font-size:14px}
.hint{color:var(--muted);font-size:12.5px;line-height:1.45}
input,select,textarea{font:inherit;width:100%;min-height:42px;padding:8px 12px;border-radius:8px;border:1px solid var(--line);background:var(--surface);color:var(--ink)}
input[type=radio]{width:auto;min-height:0}
input[type=file]{padding:8px}
textarea{resize:vertical;min-height:70px}
.inline-in{display:inline-flex;align-items:center;gap:6px}
.inline-in input{width:120px;min-height:36px;padding:4px 10px;text-align:right}
.inline-in.sm input{width:84px}
.err{color:var(--expense);font-size:14px;margin:0 0 10px;min-height:0}
.seg{display:inline-grid;grid-auto-flow:column;gap:2px;padding:3px;background:var(--surface-2);border:1px solid var(--line);border-radius:10px}
.seg label{position:relative;cursor:pointer}
.seg input{position:absolute;opacity:0;inset:0;width:100%;height:100%;margin:0;cursor:pointer}
.seg span{display:block;padding:6px 18px;border-radius:7px;font-weight:500;color:var(--muted);white-space:nowrap}
.seg input:checked+span{background:var(--surface);color:var(--ink);box-shadow:0 0 0 1px var(--line)}
.seg input:focus-visible+span{outline:2px solid var(--primary);outline-offset:1px}
.seg label.i input:checked+span{color:var(--income)} .seg label.e input:checked+span{color:var(--expense)}
.tabs{display:inline-flex;gap:4px;padding:3px;background:var(--surface-2);border:1px solid var(--line);border-radius:10px}
.tab{border:0;background:none;padding:7px 16px;border-radius:7px;color:var(--muted);font-weight:500;cursor:pointer}
.tab[aria-selected="true"]{background:var(--surface);color:var(--ink);box-shadow:0 0 0 1px var(--line)}
.chip{display:inline-flex;align-items:center;gap:5px;padding:1px 10px;border-radius:999px;font-size:13px;font-weight:500;background:var(--surface-2);color:var(--muted);white-space:nowrap}
.chip.ok{background:var(--income-soft);color:var(--income)} .chip.bad{background:var(--expense-soft);color:var(--expense)}
.chip.warn{background:var(--warn-soft);color:var(--warn)} .chip.info{background:var(--primary-soft);color:var(--primary)}
.chip.sv{background:var(--save-soft);color:var(--save)}
.filters{display:flex;flex-wrap:wrap;gap:10px;align-items:center;margin-bottom:6px}
.filters select{width:auto;min-width:150px}
.filters input[type=search]{width:min(260px,100%)}
.monthnav{display:inline-flex;align-items:center;gap:4px}
.monthnav strong{min-width:128px;text-align:center;font-family:var(--display);font-weight:500;font-size:17px}

.bar{height:8px;border-radius:99px;background:var(--surface-2);overflow:hidden;border:1px solid var(--line)}
.bar>i{display:block;height:100%;border-radius:99px;background:var(--primary)}
.bar.green>i{background:var(--income)} .bar.red>i{background:var(--expense)} .bar.amber>i{background:var(--warn)} .bar.purple>i{background:var(--save)}
.bar.lg{height:12px}
.marker{position:relative}
.marker::after{content:"";position:absolute;top:-3px;bottom:-3px;width:2px;background:var(--ink);left:var(--m,100%);opacity:.55}

/* ---------- hero (the one bold moment) ---------- */
.hero{padding:26px 28px 22px}
.hero-label{font-weight:500;color:var(--muted)}
.hero-num{font:500 clamp(46px,9vw,76px)/1.08 var(--display);letter-spacing:-.01em;margin:2px 0 4px;font-variant-numeric:tabular-nums}
.hero-num small{font-size:.42em;font-weight:500;margin-left:8px;color:var(--muted);letter-spacing:0}
.hero-sub{color:var(--muted);max-width:62ch}
.alloc{display:flex;gap:3px;height:20px;margin:22px 0 12px;border-radius:6px;overflow:hidden}
.alloc i{display:block;min-width:4px;border-radius:3px}
.legend{list-style:none;margin:0;padding:0;display:flex;flex-wrap:wrap;gap:6px 22px;font-size:14px}
.legend li{display:flex;align-items:center;gap:8px}
.legend .sw{width:11px;height:11px;border-radius:3px;flex:none}
.legend b{font-variant-numeric:tabular-nums;font-weight:600}
.hero-empty h2{font:500 22px/1.4 var(--display);margin-bottom:6px}
.hero-empty p{color:var(--muted);max-width:56ch;margin-bottom:16px}

.kpis{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));padding:0}
.kpis>div{padding:16px 20px;border-left:1px solid var(--line)}
.kpis>div:first-child{border-left:0}
.kpis span{display:block;color:var(--muted);font-size:14px}
.kpis b{display:block;font:500 24px/1.35 var(--display);font-variant-numeric:tabular-nums}

/* ---------- lists ---------- */
.list{list-style:none;margin:0;padding:0}
.row{display:grid;grid-template-columns:auto minmax(0,1fr) auto auto;gap:6px 12px;align-items:center;padding:11px 0;border-bottom:1px dashed var(--line)}
.row:last-child{border-bottom:0}
.dot{width:11px;height:11px;border-radius:50%;flex:none}
.row-main{min-width:0}
.row-main b{display:block;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;font-weight:500}
.row-main small{color:var(--muted);display:block}
.amt{font-weight:600;font-variant-numeric:tabular-nums;white-space:nowrap}
.row-actions{display:flex;gap:0}
.dayhead{display:flex;justify-content:space-between;align-items:baseline;gap:10px;font-weight:600;font-size:14px;color:var(--muted);margin:20px 0 2px;padding-bottom:4px;border-bottom:1px solid var(--line)}
.dayhead:first-child{margin-top:4px}
.empty{text-align:center;padding:38px 18px;border:1px dashed var(--line);border-radius:14px;background:var(--surface)}
.empty h3{font:500 19px/1.4 var(--display);margin-bottom:6px}
.empty p{color:var(--muted);max-width:50ch;margin:0 auto 16px}
.empty .btnrow{justify-content:center}
.daybadge{display:grid;place-items:center;width:42px;height:46px;border-radius:8px;background:var(--surface-2);border:1px solid var(--line);font-weight:600;line-height:1.15;text-align:center}
.daybadge small{display:block;color:var(--muted);font-weight:500;font-size:11.5px}
.daybadge.paid{background:var(--income-soft);border-color:transparent;color:var(--income)}
.daybadge.late{background:var(--expense-soft);border-color:transparent;color:var(--expense)}
.check{display:inline-flex;align-items:center;gap:7px;padding:5px 12px;border-radius:8px;border:1px solid var(--line);background:var(--surface);cursor:pointer;font-weight:500;font-size:14px}
.check.on{background:var(--income);border-color:var(--income);color:#fff}
:root[data-theme="dark"] .check.on{color:#0c2418}
@media (prefers-color-scheme:dark){:root:not([data-theme="light"]) .check.on{color:#0c2418}}

.ledger{list-style:none;margin:0;padding:0}
.ledger li{display:flex;align-items:baseline;gap:8px;padding:6px 0}
.ledger li::before{content:none}
.ledger .l{white-space:nowrap}
.ledger .dots{flex:1;border-bottom:2px dotted var(--line);transform:translateY(-4px);min-width:16px}
.ledger .v{font-weight:600;font-variant-numeric:tabular-nums;white-space:nowrap}
.ledger li.total{border-top:1px solid var(--ink);margin-top:6px;padding-top:10px;font-size:17px}
.ledger li.total .l{font-weight:600}

.pot{display:grid;gap:10px}
.pot-top{display:flex;justify-content:space-between;gap:10px;align-items:flex-start}
.pot h3,.item h3{font-size:16.5px;font-weight:600;line-height:1.4}
.big{font:500 28px/1.3 var(--display);font-variant-numeric:tabular-nums}
.item{display:grid;gap:10px;align-content:start}
.meta{display:flex;flex-wrap:wrap;gap:4px 14px;color:var(--muted);font-size:14px}
.card-actions{display:flex;flex-wrap:wrap;gap:6px;margin-top:2px}
.steps{display:grid;grid-template-columns:repeat(auto-fill,minmax(64px,1fr));gap:6px}
.step{border:1px solid var(--line);border-radius:8px;background:var(--surface);padding:5px 3px;font-size:12.5px;line-height:1.35;cursor:pointer;display:grid;text-align:center;color:var(--ink)}
.step b{font-size:13.5px;font-weight:600}
.step span{color:var(--muted)}
.step.done{background:var(--save);border-color:var(--save);color:var(--on-save)}
.step.done span{color:inherit;opacity:.85}
.step.late{border-color:var(--expense);border-style:dashed}
.step.next{border-color:var(--primary);box-shadow:0 0 0 1px var(--primary)}
.tpl{display:grid;grid-template-columns:repeat(auto-fill,minmax(210px,1fr));gap:10px}
.tpl button{text-align:left;padding:12px 14px;border:1px solid var(--line);background:var(--surface);border-radius:10px;cursor:pointer;display:grid;gap:2px}
.tpl button:hover{background:var(--surface-2)}
.tpl b{font-weight:600}.tpl span{color:var(--muted);font-size:13.5px;line-height:1.45}
.compare{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:12px}
.compare>div{border:1px solid var(--line);border-radius:10px;padding:12px 14px}
.compare>div.best{border-color:var(--income);background:var(--income-soft)}
.compare h4{margin:0 0 4px;font-size:15px}
.order{margin:6px 0 0;padding-left:20px;color:var(--muted);font-size:14px}

/* ---------- assessment ---------- */
.gauge{display:grid;justify-items:center}
.gauge svg{width:100%;max-width:300px;height:auto;overflow:visible}
.gauge-num{font:500 52px/1 var(--display)}
.metric{display:grid;grid-template-columns:minmax(0,1fr) auto;gap:6px 14px;padding:16px 0;border-bottom:1px dashed var(--line)}
.metric:last-child{border-bottom:0}
.metric h3{font-size:16px;font-weight:600}
.metric p{grid-column:1/-1;color:var(--muted);font-size:14.5px}
.metric .bar{grid-column:1/-1}
.todo{margin:0;padding-left:22px}
.todo li{margin-bottom:10px}
table.tbl{width:100%;border-collapse:collapse;font-variant-numeric:tabular-nums}
.tbl th{font-weight:500;color:var(--muted);text-align:right;padding:6px 8px;border-bottom:1px solid var(--line);font-size:14px}
.tbl td{padding:8px;text-align:right;border-bottom:1px dashed var(--line)}
.tbl th:first-child,.tbl td:first-child{text-align:left}
.catrow{display:grid;grid-template-columns:minmax(120px,1.2fr) auto minmax(100px,1.4fr) minmax(88px,auto);gap:8px 14px;align-items:center;padding:9px 0;border-bottom:1px dashed var(--line)}
.catrow:last-child{border-bottom:0}
.catrow .nm{display:flex;align-items:center;gap:9px;min-width:0}
.catrow .st{text-align:right;font-size:14px;font-variant-numeric:tabular-nums}

/* ---------- modal ---------- */
#modal{position:fixed;inset:0;z-index:60;background:var(--scrim);display:grid;place-items:center;padding:16px}
.sheet{background:var(--surface);border:1px solid var(--line);border-radius:16px;width:min(540px,100%);max-height:100%;overflow:auto;padding:20px 22px 22px}
.sheet header{display:flex;justify-content:space-between;align-items:center;gap:10px;margin-bottom:14px}
.sheet h2{font:500 20px/1.4 var(--display)}
.sheet footer{display:flex;justify-content:flex-end;gap:8px;margin-top:6px}
.sheet .list .row{grid-template-columns:minmax(0,1fr) auto auto}
#toast{position:fixed;left:50%;bottom:calc(26px + env(safe-area-inset-bottom,0px));transform:translateX(-50%);background:var(--ink);color:var(--paper);padding:9px 18px;border-radius:999px;font-weight:500;z-index:80;max-width:calc(100% - 32px);text-align:center}
#splash{min-height:100%;display:grid;place-items:center;text-align:center;color:var(--muted);padding:40px}
#splash b{display:block;font:500 24px/1.4 var(--display);color:var(--ink)}

/* ---------- mobile ---------- */
.bottomnav,.fab{display:none}
@media (max-width:1000px){
  .grid-wide{grid-template-columns:1fr}
}
@media (max-width:899px){
  .app{display:block}
  .side{display:none}
  .main{padding:20px 16px 130px}
  .pagehead h1{font-size:24px}
  .grid2{grid-template-columns:1fr}
  .kpis{grid-template-columns:repeat(2,minmax(0,1fr))}
  .kpis>div:nth-child(3){border-left:0}
  .kpis>div:nth-child(n+3){border-top:1px solid var(--line)}
  .hero{padding:20px 18px 18px}
  .bottomnav{display:grid;grid-template-columns:repeat(5,1fr);position:fixed;left:0;right:0;bottom:0;z-index:40;background:var(--surface);border-top:1px solid var(--line);padding:6px 4px calc(6px + env(safe-area-inset-bottom,0px))}
  .bottomnav button{display:grid;justify-items:center;gap:1px;padding:5px 2px;border:0;background:none;color:var(--muted);font-size:11.5px;font-weight:500;line-height:1.3;cursor:pointer;border-radius:8px}
  .bottomnav button[aria-current="page"]{color:var(--primary)}
  .fab{display:inline-flex;align-items:center;gap:8px;position:fixed;right:16px;bottom:calc(78px + env(safe-area-inset-bottom,0px));z-index:41;padding:12px 18px;border-radius:999px;border:0;background:var(--primary);color:var(--on-primary);font-weight:600;cursor:pointer;box-shadow:0 4px 14px rgba(0,0,0,.25)}
  #modal{place-items:end center;padding:0}
  .sheet{border-radius:18px 18px 0 0;width:100%;max-height:92%;padding-bottom:calc(22px + env(safe-area-inset-bottom,0px))}
  input,select,textarea{font-size:16px}
  .catrow{grid-template-columns:minmax(0,1fr) auto;}
  .catrow .bar{grid-column:1/-1;order:3}
  .catrow .st{grid-column:1/-1;order:4;text-align:left}
  .compare{grid-template-columns:1fr}
  .monthnav strong{min-width:112px}
  .tbl th,.tbl td{padding:6px 4px;font-size:14px}
}
@media (max-width:420px){
  .row{grid-template-columns:auto minmax(0,1fr) auto}
  .row .row-actions{grid-column:2/-1;justify-self:end}
  .hero-num{font-size:46px}
}
@media (prefers-reduced-motion:reduce){*{transition:none!important;animation:none!important}}


#authGate{position:fixed;inset:0;z-index:1000;background:var(--paper);display:grid;place-items:center;padding:20px}
.auth-card{width:min(430px,100%);background:var(--surface);border:1px solid var(--line);border-radius:18px;padding:26px;box-shadow:0 12px 40px rgba(0,0,0,.08)}
.auth-card h1{font:500 26px/1.3 var(--display);margin:0 0 5px}.auth-card p{color:var(--muted);margin-bottom:18px}
.auth-tabs{display:flex;gap:8px;margin-bottom:18px}.auth-tabs button{flex:1}
.auth-msg{font-size:14px;color:var(--expense);min-height:22px;margin:6px 0}

</style>
</head>
<body>

<div id="authGate" hidden>
  <section class="auth-card" aria-labelledby="authTitle">
    <div class="brand" style="padding:0 0 16px"><div class="brand-mark">฿</div><div><div class="brand-name">สมุดเงิน</div><div class="brand-sub">บันทึก วางแผน ประเมิน</div></div></div>
    <h1 id="authTitle">เข้าสู่ระบบ</h1>
    <p>ข้อมูลการเงินของคุณจะบันทึกแยกตามบัญชีในฐานข้อมูล</p>
    <div class="auth-tabs"><button class="btn primary" id="loginTab" type="button">เข้าสู่ระบบ</button><button class="btn" id="registerTab" type="button">สมัครสมาชิก</button></div>
    <form id="authForm">
      <div class="fld" id="nameField" hidden><label for="authName">ชื่อที่แสดง</label><input id="authName" name="name" autocomplete="name" maxlength="100"></div>
      <div class="fld"><label for="authEmail">อีเมล</label><input id="authEmail" name="email" type="email" autocomplete="username" required maxlength="190"></div>
      <div class="fld"><label for="authPassword">รหัสผ่าน (อย่างน้อย 8 ตัวอักษร)</label><input id="authPassword" name="password" type="password" autocomplete="current-password" minlength="8" required></div>
      <div class="auth-msg" id="authMsg" role="status"></div>
      <button class="btn primary" id="authSubmit" type="submit" style="width:100%">เข้าสู่ระบบ</button>
    </form>
    <p style="font-size:12px;margin:14px 0 0">หากเป็นเครื่องสาธารณะ กรุณาออกจากระบบเมื่อใช้งานเสร็จ</p>
  </section>
</div>

<div id="splash"><div><b>สมุดเงิน</b>กำลังเปิดสมุดบัญชีของคุณ…</div></div>
<div class="app" id="app" hidden>
  <aside class="side">
    <div class="brand"><div class="brand-mark" aria-hidden="true">฿</div><div><div class="brand-name">สมุดเงิน</div><div class="brand-sub">บันทึก วางแผน ประเมิน</div></div></div>
    <nav id="sidenav" aria-label="เมนูหลัก" style="display:grid;gap:3px"></nav>
    <button class="navbtn" id="sidegear" data-go="settings" style="margin-top:8px"><svg class="ic" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="3"/><path d="M12 2.5v3M12 18.5v3M2.5 12h3M18.5 12h3M5.3 5.3l2.1 2.1M16.6 16.6l2.1 2.1M18.7 5.3l-2.1 2.1M7.4 16.6l-2.1 2.1"/></svg><span>ตั้งค่าและข้อมูล</span></button>
    <div class="side-foot"><div id="sync"></div><div id="accountInfo" style="margin-top:8px"></div><button class="btn sm" id="logoutBtn" type="button" style="margin-top:8px;width:100%">ออกจากระบบ</button></div>
  </aside>
  <main class="main" id="view"></main>
  <nav class="bottomnav" id="bottomnav" aria-label="เมนูหลัก"></nav>
  <button class="fab" data-act="tx-add" aria-label="บันทึกรายการ"><svg class="ic" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M12 5v14M5 12h14"/></svg>บันทึกรายการ</button>
</div>
<div id="modal" hidden></div>
<div id="toast" role="status" aria-live="polite" hidden></div>
<script>
'use strict';
/* ============ helpers ============ */
const $ = (s, r = document) => r.querySelector(s);
const $$ = (s, r = document) => [...r.querySelectorAll(s)];
const esc = s => String(s ?? '').replace(/[&<>"']/g, c => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));
const uid = () => Math.random().toString(36).slice(2, 9) + Date.now().toString(36).slice(-4);
const num = v => { const n = parseFloat(String(v ?? '').replace(/,/g, '')); return isFinite(n) ? n : 0; };
const sum = (a, f = x => x) => a.reduce((t, x) => t + f(x), 0);
const clamp = (x, a = 0, b = 100) => Math.max(a, Math.min(b, x));
const p2 = n => String(n).padStart(2, '0');

const TH_M = ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'];
const TH_MF = ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'];
const TH_D = ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'];

const toStr = d => d.getFullYear() + '-' + p2(d.getMonth() + 1) + '-' + p2(d.getDate());
const today = () => toStr(new Date());
const parseD = s => { const [y, m, d] = s.split('-').map(Number); return new Date(y, m - 1, d); };
const dayDiff = (a, b) => Math.round((parseD(b) - parseD(a)) / 86400000);
const curYm = () => today().slice(0, 7);
const shiftYm = (ym, n) => { const [y, m] = ym.split('-').map(Number); const d = new Date(y, m - 1 + n, 1); return d.getFullYear() + '-' + p2(d.getMonth() + 1); };
const monthsBetween = (a, b) => { const [y1, m1] = a.slice(0, 7).split('-').map(Number), [y2, m2] = b.slice(0, 7).split('-').map(Number); return (y2 - y1) * 12 + (m2 - m1); };
const daysIn = (y, m) => new Date(y, m, 0).getDate();
const ymLabel = ym => { const [y, m] = ym.split('-').map(Number); return TH_MF[m - 1] + ' ' + (y + 543); };
const ymShort = ym => { const [y, m] = ym.split('-').map(Number); return TH_M[m - 1] + ' ' + String(y + 543).slice(2); };
const fmtDate = s => { const d = parseD(s); return d.getDate() + ' ' + TH_M[d.getMonth()] + ' ' + (d.getFullYear() + 543); };
const fmtDay = s => { const d = parseD(s); return TH_D[d.getDay()] + 'ที่ ' + d.getDate() + ' ' + TH_MF[d.getMonth()]; };

const nf0 = new Intl.NumberFormat('en-US', { maximumFractionDigits: 0 });
const nf2 = new Intl.NumberFormat('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
const money = n => { const r = Math.round(n); return (r < 0 ? '-' : '') + '฿' + nf0.format(Math.abs(r)); };
const moneyx = n => { const a = Math.abs(n); return (n < -0.004 ? '-' : '') + '฿' + (Math.abs(a - Math.round(a)) < 0.005 ? nf0.format(Math.round(a)) : nf2.format(a)); };
const pct = (x, d = 0) => (x * 100).toFixed(d) + '%';

/* ============ categories ============ */
const CATS_EXP = [
  { id: 'food', name: 'อาหาร', grp: 'need', color: '#D9822B' },
  { id: 'transport', name: 'เดินทาง', grp: 'need', color: '#3B82A0' },
  { id: 'housing', name: 'ที่อยู่อาศัย', grp: 'need', color: '#5B6FB5' },
  { id: 'utilities', name: 'น้ำ ไฟ เน็ต มือถือ', grp: 'need', color: '#2F9C95' },
  { id: 'health', name: 'สุขภาพ', grp: 'need', color: '#C65D7B' },
  { id: 'insurance', name: 'ประกัน', grp: 'need', color: '#7F8FA6' },
  { id: 'family', name: 'ครอบครัว', grp: 'need', color: '#9C6BB3' },
  { id: 'education', name: 'การศึกษา', grp: 'need', color: '#4F9D69' },
  { id: 'debt', name: 'ผ่อนชำระหนี้', grp: 'need', color: '#A64B45' },
  { id: 'dining', name: 'กินนอกบ้าน/คาเฟ่', grp: 'want', color: '#E2A93B' },
  { id: 'shopping', name: 'ช้อปปิ้ง', grp: 'want', color: '#D4668A' },
  { id: 'fun', name: 'บันเทิง/ท่องเที่ยว', grp: 'want', color: '#8E6FD1' },
  { id: 'other', name: 'อื่นๆ', grp: 'want', color: '#8A949E' },
];
const CATS_INC = [
  { id: 'salary', name: 'เงินเดือน', color: '#157A55' },
  { id: 'side', name: 'งานเสริม/ฟรีแลนซ์', color: '#2F9C95' },
  { id: 'bonus', name: 'โบนัส/คอมมิชชั่น', color: '#4F9D69' },
  { id: 'biz', name: 'ธุรกิจ/ขายของ', color: '#5B6FB5' },
  { id: 'invest', name: 'ดอกเบี้ย/ปันผล', color: '#8E6FD1' },
  { id: 'gift', name: 'ได้รับ/ของขวัญ', color: '#D4668A' },
  { id: 'other', name: 'อื่นๆ', color: '#8A949E' },
];
const catOf = (type, id) => (type === 'income' ? CATS_INC : CATS_EXP).find(c => c.id === id) || { id: 'other', name: 'อื่นๆ', color: '#8A949E', grp: 'want' };
const DEBT_TYPES = ['บัตรเครดิต', 'สินเชื่อส่วนบุคคล', 'ผ่อนรถ', 'ผ่อนบ้าน/คอนโด', 'กู้เรียน (กยศ.)', 'ผ่อนสินค้า', 'ยืมเงินคนรู้จัก', 'อื่นๆ'];

/* ============ state ============ */
const KEY = 'sammut-ngern-v1';
const blank = () => ({
  v: 1, updatedAt: 0,
  settings: { name: '', baseIncome: 0, savePct: 10, ratio: [50, 30, 20], budgets: {}, projRate: 3 },
  tx: [], bills: [], pots: [], plans: [], debts: [], goals: [], wishes: [],
});
let state = blank();
function normalize(s) {
  const b = blank(); const o = { ...b, ...(s || {}) };
  o.settings = { ...b.settings, ...((s && s.settings) || {}) };
  if (!Array.isArray(o.settings.ratio) || o.settings.ratio.length !== 3) o.settings.ratio = [50, 30, 20];
  if (!o.settings.budgets || typeof o.settings.budgets !== 'object') o.settings.budgets = {};
  for (const k of ['tx', 'bills', 'pots', 'plans', 'debts', 'goals', 'wishes']) if (!Array.isArray(o[k])) o[k] = [];
  o.tx = o.tx.filter(t => t && typeof t.date === 'string' && isFinite(t.amount));
  o.bills.forEach(b => { b.paid = b.paid || {}; });
  o.pots.forEach(p => { p.log = p.log || []; });
  o.debts.forEach(d => { d.payments = d.payments || []; });
  o.goals.forEach(g => { g.log = g.log || []; });
  return o;
}
const ui = { page: 'home', ym: curYm(), txType: 'all', txCat: 'all', q: '', saveTab: 'pots', showBought: false, strategy: 'avalanche', extra: 0, projMonthly: null };

/* ============ persistence (PHP + MySQL API, local backup fallback) ============ */
const remote = { ok: false };
let flushTimer = null, flushing = false, flushAgain = false;
const loadLocal = () => { try { const s = localStorage.getItem(KEY); return s ? JSON.parse(s) : null; } catch (e) { return null; } };
const saveLocal = () => { try { localStorage.setItem(KEY, JSON.stringify(state)); } catch (e) {} };
let lastSync = 'local';
let currentUser = null;
let authMode = 'login';
function setSync(kind) {
  lastSync = kind;
  const el = $('#sync'); if (!el) return;
  const map = {
    cloud: ['cloud', 'บันทึกลงฐานข้อมูลแล้ว'],
    busy: ['busy', 'กำลังบันทึกลงฐานข้อมูล…'],
    local: ['', 'โหมดสำรอง: เก็บในเบราว์เซอร์เครื่องนี้'],
    err: ['err', 'เชื่อมต่อฐานข้อมูลไม่สำเร็จ ข้อมูลสำรองอยู่ในเครื่องนี้'],
  };
  const [cls, txt] = map[kind] || map.local;
  el.innerHTML = `<span class="sync-dot ${cls}"></span>${txt}`;
  const e2 = $('#sync2'); if (e2) e2.innerHTML = el.innerHTML;
}
async function api(path, data) {
  const res = await fetch('api/' + path, {
    method: data === undefined ? 'GET' : 'POST',
    credentials: 'same-origin',
    headers: data === undefined ? {} : {'Content-Type':'application/json'},
    body: data === undefined ? undefined : JSON.stringify(data)
  });
  const json = await res.json().catch(() => ({}));
  if (!res.ok || json.ok === false) throw new Error(json.error || 'เกิดข้อผิดพลาดในการเชื่อมต่อ');
  return json;
}
async function flush() {
  if (!currentUser) return;
  if (flushing) { flushAgain = true; return; }
  flushing = true;
  try {
    await api('state.php', {state});
    remote.ok = true; setSync('cloud');
  } catch (e) { console.warn('save failed', e); setSync('err'); }
  flushing = false;
  if (flushAgain) { flushAgain = false; flush(); }
}
function commit(rerender = true) {
  state.updatedAt = Date.now(); saveLocal();
  if (currentUser) { setSync('busy'); clearTimeout(flushTimer); flushTimer = setTimeout(flush, 450); }
  if (rerender) render();
}
function setAuthMode(mode) {
  authMode = mode;
  $('#authTitle').textContent = mode === 'login' ? 'เข้าสู่ระบบ' : 'สร้างบัญชีใหม่';
  $('#authSubmit').textContent = mode === 'login' ? 'เข้าสู่ระบบ' : 'สมัครสมาชิก';
  $('#loginTab').classList.toggle('primary', mode === 'login');
  $('#registerTab').classList.toggle('primary', mode === 'register');
  $('#nameField').hidden = mode !== 'register';
  $('#authPassword').autocomplete = mode === 'login' ? 'current-password' : 'new-password';
  $('#authMsg').textContent = '';
}
function showAuth() { $('#authGate').hidden = false; $('#app').hidden = true; $('#splash').hidden = true; }
function enterApp(user) {
  currentUser = user;
  $('#authGate').hidden = true; $('#app').hidden = false;
  const ai = $('#accountInfo'); if (ai) ai.textContent = user ? ('บัญชี: ' + user.email) : '';
  const lo = $('#logoutBtn'); if (lo) lo.hidden = !user;
}
async function boot() {
  $('#loginTab').addEventListener('click', () => setAuthMode('login'));
  $('#registerTab').addEventListener('click', () => setAuthMode('register'));
  $('#authForm').addEventListener('submit', async e => {
    e.preventDefault(); $('#authMsg').textContent = '';
    const email = $('#authEmail').value.trim(), password = $('#authPassword').value;
    const name = $('#authName').value.trim();
    const endpoint = authMode === 'login' ? 'login.php' : 'register.php';
    $('#authSubmit').disabled = true;
    try {
      const result = await api(endpoint, {email, password, name});
      currentUser = result.user;
      const saved = await api('state.php');
      if (saved.state) state = normalize(saved.state);
      else {
        const local = loadLocal();
        state = local ? normalize(local) : blank();
        await api('state.php', {state});
      }
      saveLocal(); enterApp(currentUser); booted = true; render(); setSync('cloud');
    } catch (err) { $('#authMsg').textContent = err.message || 'เข้าสู่ระบบไม่สำเร็จ'; }
    finally { $('#authSubmit').disabled = false; }
  });
  $('#logoutBtn').addEventListener('click', async () => {
    try { await api('logout.php', {}); } catch(e) {}
    currentUser = null; remote.ok = false; showAuth(); setAuthMode('login');
  });
  try {
    const session = await api('me.php');
    if (session.user) {
      currentUser = session.user;
      const saved = await api('state.php');
      if (saved.state) state = normalize(saved.state);
      else { const local = loadLocal(); if (local) state = normalize(local); await api('state.php', {state}); }
      saveLocal(); enterApp(currentUser); booted = true; render(); setSync('cloud'); return;
    }
  } catch(e) { console.warn('API unavailable; login is still shown', e); }
  showAuth(); setAuthMode('login');
}
/* ============ calculations ============ */
function monthStats(ym) {
  let income = 0, expense = 0, need = 0, want = 0, billsLinked = 0, debtLinked = 0;
  const byCat = {}, byInc = {};
  for (const t of state.tx) {
    if (!t.date.startsWith(ym)) continue;
    if (t.type === 'income') { income += t.amount; byInc[t.cat] = (byInc[t.cat] || 0) + t.amount; }
    else {
      expense += t.amount; byCat[t.cat] = (byCat[t.cat] || 0) + t.amount;
      if (catOf('expense', t.cat).grp === 'need') need += t.amount; else want += t.amount;
      if (t.billId) billsLinked += t.amount; if (t.debtId) debtLinked += t.amount;
    }
  }
  return { income, expense, need, want, net: income - expense, byCat, byInc, billsLinked, debtLinked, rate: income > 0 ? (income - expense) / income : null };
}
const hasTx = m => state.tx.some(t => t.date.startsWith(m));
function basisMonths() {
  const cur = curYm(); const prev = [1, 2, 3].map(i => shiftYm(cur, -i)).filter(hasTx);
  if (prev.length) return prev; return hasTx(cur) ? [cur] : [];
}
function avgBasis() {
  const bm = basisMonths(); if (!bm.length) return { n: 0, income: 0, expense: 0, need: 0, months: [] };
  const sts = bm.map(monthStats); const avg = f => sum(sts, f) / sts.length;
  return { n: bm.length, income: avg(s => s.income), expense: avg(s => s.expense), need: avg(s => s.need), months: bm, sts };
}
function expectedIncome() { return state.settings.baseIncome > 0 ? state.settings.baseIncome : avgBasis().income; }

/* bills */
function billDue(b, ym) {
  const [y, m] = ym.split('-').map(Number);
  if (b.startYm && ym < b.startYm) return null;
  const d = Math.min(Math.max(1, b.dueDay || 1), daysIn(y, m));
  if (b.freq === 'monthly') return ym + '-' + p2(d);
  if (b.freq === 'yearly') return b.dueMonth === m ? ym + '-' + p2(d) : null;
  if (b.freq === 'once') return b.dueDate && b.dueDate.slice(0, 7) === ym ? b.dueDate : null;
  return null;
}
function billsForMonth(ym) {
  return state.bills.map(b => {
    if (b.active === false && !b.paid[ym]) return null;
    const date = billDue(b, ym); if (!date) return null;
    return { bill: b, date, paid: !!b.paid[ym] };
  }).filter(Boolean).sort((a, b) => a.date.localeCompare(b.date));
}
function billStatus(it) {
  if (it.paid) return 'paid'; const t = today();
  if (it.date < t) return 'overdue'; if (dayDiff(t, it.date) <= 3) return 'soon'; return 'later';
}
function payBill(b, ym) {
  const due = billDue(b, ym); const date = ym === curYm() ? today() : due;
  const id = uid(); state.tx.push({ id, type: 'expense', amount: b.amount, cat: b.cat, date, note: b.name, billId: b.id }); b.paid[ym] = id;
}
function unpayBill(b, ym) { const id = b.paid[ym]; delete b.paid[ym]; state.tx = state.tx.filter(t => t.id !== id); }

/* pots / plans / goals */
const potBal = p => sum(p.log, l => l.amount);
const potsTotal = () => sum(state.pots, potBal);
const savedInMonth = ym => sum(state.pots, p => sum(p.log.filter(l => !l.opening && l.date.startsWith(ym)), l => l.amount));
function potAdd(p, amount, date, note, extra = {}) { const id = uid(); p.log.push({ id, date, amount, note: note || '', ...extra }); return id; }
function makePlan(o) {
  const n = o.kind === 'week52' ? 52 : o.count; const steps = [];
  for (let i = 0; i < n; i++) {
    let label, amt;
    if (o.kind === 'week52') { label = 'สัปดาห์ ' + (i + 1); amt = (i + 1) * o.amount; }
    else if (o.kind === 'weekly') { label = 'สัปดาห์ ' + (i + 1); amt = o.amount; }
    else if (o.kind === 'daily') { label = 'วันที่ ' + (i + 1); amt = o.amount; }
    else { label = ymShort(shiftYm(o.start.slice(0, 7), i)); amt = o.kind === 'percent' ? Math.round(o.income * o.pct / 100) : o.amount; }
    steps.push({ label, amount: amt, done: null, logId: null });
  }
  return { id: uid(), kind: o.kind, name: o.name, potId: o.potId || null, start: o.start, period: { week52: 'week', weekly: 'week', daily: 'day', monthly: 'month', percent: 'month' }[o.kind], steps };
}
function planExpected(pl) {
  const t = today(); if (t < pl.start) return 0; let e;
  if (pl.period === 'day') e = dayDiff(pl.start, t) + 1;
  else if (pl.period === 'week') e = Math.floor(dayDiff(pl.start, t) / 7) + 1;
  else e = monthsBetween(pl.start, t) + 1;
  return Math.min(e, pl.steps.length);
}
const planSaved = pl => sum(pl.steps.filter(s => s.done), s => s.amount);
const planTotal = pl => sum(pl.steps, s => s.amount);
function toggleStep(pl, i) {
  const s = pl.steps[i]; const pot = state.pots.find(p => p.id === pl.potId);
  if (s.done) { if (pot && s.logId) pot.log = pot.log.filter(l => l.id !== s.logId); s.done = null; s.logId = null; }
  else { s.done = today(); if (pot) s.logId = potAdd(pot, s.amount, s.done, pl.name + ' · ' + s.label, { planId: pl.id }); }
}
const goalPot = g => g.potId ? state.pots.find(p => p.id === g.potId) : null;
const goalSaved = g => { const p = goalPot(g); return p ? potBal(p) : sum(g.log, l => l.amount); };

/* debts */
const activeDebts = () => state.debts.filter(d => d.balance > 0.005);
function payDebt(d, amount, date, note) {
  const applied = Math.min(amount, d.balance); d.balance = Math.max(0, d.balance - applied); if (d.balance < 0.005) d.balance = 0;
  const txId = uid(); state.tx.push({ id: txId, type: 'expense', amount, cat: 'debt', date, note: 'ผ่อน ' + d.name + (note ? ' · ' + note : ''), debtId: d.id });
  d.payments.push({ id: uid(), date, amount, applied, txId });
}
function undoDebtPayment(d, pid) {
  const p = d.payments.find(x => x.id === pid); if (!p) return;
  d.balance += p.applied; d.payments = d.payments.filter(x => x !== p); state.tx = state.tx.filter(t => t.id !== p.txId);
}
function payoffInfo(balance, apr, pay) {
  if (balance <= 0) return { months: 0, interest: 0 };
  if (pay <= 0) return { months: Infinity, interest: Infinity };
  const r = apr / 1200;
  if (r === 0) { const n = Math.ceil(balance / pay); return { months: n, interest: 0 }; }
  if (pay <= balance * r) return { months: Infinity, interest: Infinity };
  const n = -Math.log(1 - r * balance / pay) / Math.log(1 + r);
  return { months: Math.ceil(n), interest: Math.max(0, n * pay - balance) };
}
function simulateDebts(debts, extra, strategy) {
  let ds = debts.filter(d => d.balance > 0.005).map(d => ({ id: d.id, name: d.name, balance: d.balance, rate: d.rate || 0, minPay: d.minPay || 0, cleared: null }));
  if (!ds.length) return { months: 0, interest: 0, order: [] };
  const budget = sum(ds, d => d.minPay) + extra;
  const startInterest = sum(ds, d => d.balance * d.rate / 1200);
  if (budget <= startInterest + 0.01 || budget <= 0) return { months: Infinity, interest: Infinity, order: [] };
  const sorter = strategy === 'avalanche' ? (a, b) => b.rate - a.rate || a.balance - b.balance : (a, b) => a.balance - b.balance;
  let months = 0, interest = 0;
  while (ds.some(d => d.balance > 0.005) && months < 600) {
    months++;
    for (const d of ds) if (d.balance > 0) { const i = d.balance * d.rate / 1200; d.balance += i; interest += i; }
    let pool = budget;
    for (const d of ds) if (d.balance > 0) { const p = Math.min(d.minPay, d.balance, pool); d.balance -= p; pool -= p; }
    for (const d of [...ds].filter(x => x.balance > 0.005).sort(sorter)) { if (pool <= 0) break; const p = Math.min(pool, d.balance); d.balance -= p; pool -= p; }
    for (const d of ds) if (d.balance <= 0.005 && d.cleared === null) { d.balance = 0; d.cleared = months; }
  }
  if (ds.some(d => d.balance > 0.005)) return { months: Infinity, interest: Infinity, order: [] };
  return { months, interest, order: [...ds].sort((a, b) => a.cleared - b.cleared).map(d => ({ name: d.name, at: d.cleared })) };
}

/* monthly plan (the allocation that drives the hero + budget page) */
function monthPlan(ym) {
  const st = monthStats(ym), cur = curYm(), expected = expectedIncome();
  const basis = ym < cur ? (st.income || expected) : Math.max(st.income, expected);
  const items = billsForMonth(ym);
  const billsTotal = sum(items, i => i.bill.amount), billsPaid = sum(items.filter(i => i.paid), i => i.bill.amount);
  const unpaidBills = billsTotal - billsPaid;
  let debtMin = 0, debtRemaining = 0;
  for (const d of state.debts) {
    const paid = sum(d.payments.filter(p => p.date.startsWith(ym)), p => p.amount);
    const planned = Math.min(d.minPay || 0, d.balance + sum(d.payments.filter(p => p.date.startsWith(ym)), p => p.applied));
    debtMin += planned; debtRemaining += Math.max(0, planned - paid);
  }
  const saveTarget = basis * (state.settings.savePct || 0) / 100;
  const savedSoFar = savedInMonth(ym);
  const saveRemaining = Math.max(0, saveTarget - savedSoFar);
  const flexSpent = st.expense - st.billsLinked - st.debtLinked;
  const flexBudget = basis - billsTotal - debtMin - saveTarget;
  const left = basis - st.expense - unpaidBills - debtRemaining - saveRemaining;
  return { st, basis, billsTotal, billsPaid, unpaidBills, debtMin, debtRemaining, debtPaid: st.debtLinked, saveTarget, savedSoFar, saveRemaining, flexSpent, flexBudget, left, spentTotal: st.expense };
}

/* assessment */
function assess() {
  const av = avgBasis(); if (!av.n) return null;
  if (av.income <= 0) return { noIncome: true, av };
  const inc = av.income, exp = av.expense, need = av.need, rate = (inc - exp) / inc;
  const total = potsTotal(); const em = state.pots.filter(p => p.kind === 'emergency');
  const emBal = em.length ? sum(em, potBal) : total, emAll = !em.length;
  const emMonths = exp > 0 ? emBal / exp : 12;
  const dm = sum(activeDebts(), d => d.minPay || 0), dti = dm / inc;
  const needRatio = need / inc;
  const billItems = billsForMonth(curYm()); const overdue = billItems.filter(i => billStatus(i) === 'overdue').length;
  const M = [];
  M.push({
    key: 'save', title: 'อัตราการออม', weight: 30, value: pct(rate), target: 'เป้าหมาย 20% ขึ้นไป', score: clamp(rate / 0.2 * 100),
    advice: rate >= 0.2 ? 'ออมได้ตามเกณฑ์ ถ้าจะให้เงินงอกเงยต่อ ให้ย้ายส่วนที่เหลือเข้ากระปุกเงินเก็บทุกเดือน'
      : rate >= 0 ? `ถ้าเพิ่มเงินออมอีกเดือนละ ${money(inc * 0.2 - (inc - exp))} จะถึง 20% ลองตั้งโอนเข้ากระปุกทันทีที่เงินเดือนเข้า แล้วใช้ส่วนที่เหลือ`
        : `รายจ่ายมากกว่ารายรับเฉลี่ยเดือนละ ${money(exp - inc)} เริ่มจากดูหมวดที่ใช้มากที่สุดในหน้าภาพรวม`,
  });
  M.push({
    key: 'emergency', title: 'เงินสำรองฉุกเฉิน', weight: 25, value: (emMonths >= 12 ? '12+' : emMonths.toFixed(1)) + ' เดือน', target: 'เป้าหมาย 6 เดือนของรายจ่าย', score: clamp(emMonths / 6 * 100),
    advice: (emAll && state.pots.length ? 'ยังไม่ได้ตั้งกระปุกเป็นเงินสำรองฉุกเฉิน จึงนับรวมเงินเก็บทั้งหมด ' : '') + (emMonths >= 6 ? 'พอสำหรับเหตุไม่คาดฝัน ถ้ารายได้หายไปยังอยู่ได้เกินครึ่งปี'
      : emMonths >= 3 ? `ผ่านขั้นต่ำ 3 เดือนแล้ว เก็บเพิ่มอีก ${money(exp * 6 - emBal)} จะครบ 6 เดือน`
        : exp > 0 ? `ตั้งเป้าให้ถึง 3 เดือนก่อน (${money(exp * 3)}) ยังขาดอีก ${money(exp * 3 - emBal)}` : 'เริ่มสร้างกระปุกเงินสำรองฉุกเฉินได้ที่หน้าเงินเก็บ'),
  });
  M.push({
    key: 'debt', title: 'ภาระผ่อนหนี้ต่อรายได้', weight: 20, value: dm > 0 ? pct(dti) : 'ไม่มี', target: 'ไม่ควรเกิน 35% ของรายได้', score: dm > 0 ? clamp((0.5 - dti) / 0.35 * 100) : 100,
    advice: dm === 0 ? 'ไม่มีภาระผ่อนหนี้ประจำ ถือว่าคล่องตัวมาก' : dti <= 0.15 ? 'ภาระหนี้อยู่ในระดับสบาย'
      : dti <= 0.35 ? 'ยังอยู่ในเกณฑ์ แต่ควรระวังไม่ก่อหนี้เพิ่ม และจ่ายหนี้ดอกเบี้ยสูงให้หมดก่อน'
        : `ภาระหนี้สูง ผ่อนรวม ${money(dm)} ต่อเดือน ลองดูแผนปิดหนี้ในหน้าหนี้สิน และเลี่ยงการเปิดหนี้ใหม่`,
  });
  M.push({
    key: 'needs', title: 'รายจ่ายจำเป็นต่อรายได้', weight: 15, value: pct(needRatio), target: 'ไม่ควรเกิน 50% ของรายได้', score: clamp((0.8 - needRatio) / 0.3 * 100),
    advice: needRatio <= 0.5 ? 'ค่าใช้จ่ายจำเป็นอยู่ในเกณฑ์ มีพื้นที่เหลือให้ออมและใช้จ่ายตามใจ'
      : `ค่าใช้จ่ายจำเป็นสูงกว่า 50% อยู่ ${money(need - inc * 0.5)} ต่อเดือน ลองทบทวนค่าที่อยู่ ค่าเดินทาง และค่าผ่อนที่ลดได้`,
  });
  if (billItems.length) M.push({
    key: 'bills', title: 'จ่ายบิลตรงเวลา', weight: 10, value: overdue ? `ค้าง ${overdue} รายการ` : 'ไม่มีค้าง', target: 'ไม่ควรมีบิลเลยกำหนด', score: clamp(100 - overdue * 35),
    advice: overdue ? 'จ่ายบิลที่เลยกำหนดก่อน เพื่อเลี่ยงค่าปรับและผลต่อเครดิต หรือใช้การตัดบัญชีอัตโนมัติ' : 'ไม่มีบิลเลยกำหนด รักษาไว้',
  });
  const wsum = sum(M, m => m.weight), score = Math.round(sum(M, m => m.score * m.weight) / wsum);
  M.forEach(m => { m.score = Math.round(m.score); m.status = m.score >= 75 ? 'good' : m.score >= 45 ? 'fair' : 'poor'; });
  const grade = score >= 80 ? ['แข็งแรงมาก', 'ok'] : score >= 65 ? ['ค่อนข้างดี', 'ok'] : score >= 50 ? ['พอใช้', 'warn'] : score >= 35 ? ['ควรปรับปรุง', 'warn'] : ['เสี่ยง', 'bad'];
  const todo = M.filter(m => m.score < 75).sort((a, b) => b.weight * (100 - b.score) - a.weight * (100 - a.score)).slice(0, 3);
  return { score, grade, M, todo, av, inc, exp, rate, total, emBal, emMonths };
}
function fv(p0, pmt, rateYr, years) {
  const i = rateYr / 1200, n = years * 12;
  if (i === 0) return p0 + pmt * n; const g = Math.pow(1 + i, n);
  return p0 * g + pmt * (g - 1) / i;
}

/* ============ icons & components ============ */
const IC = {
  home: '<path d="M3 10.5 12 3l9 7.5"/><path d="M5 9.5V21h14V9.5"/><path d="M10 21v-6h4v6"/>',
  swap: '<path d="M7 4 3 8l4 4"/><path d="M3 8h14"/><path d="m17 12 4 4-4 4"/><path d="M21 16H7"/>',
  calendar: '<rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 10h18M8 3v4M16 3v4"/>',
  coins: '<ellipse cx="12" cy="6" rx="8" ry="3"/><path d="M4 6v6c0 1.7 3.6 3 8 3s8-1.3 8-3V6"/><path d="M4 12v6c0 1.7 3.6 3 8 3s8-1.3 8-3v-6"/>',
  card: '<rect x="2.5" y="5" width="19" height="14" rx="2"/><path d="M2.5 10h19M6 15h4"/>',
  target: '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="5"/><circle cx="12" cy="12" r="1.2"/>',
  heart: '<path d="M12 20.5s-8-4.6-8-10.4A4.6 4.6 0 0 1 12 7.4a4.6 4.6 0 0 1 8 2.7c0 5.8-8 10.4-8 10.4Z"/>',
  sliders: '<path d="M4 6h8M18 6h2M4 12h2M12 12h8M4 18h10M20 18h0"/><circle cx="15" cy="6" r="2"/><circle cx="9" cy="12" r="2"/><circle cx="17" cy="18" r="2"/>',
  pulse: '<path d="M3 12h4l3-8 4 16 3-8h4"/>',
  gear: '<circle cx="12" cy="12" r="3"/><path d="M12 2.5v3M12 18.5v3M2.5 12h3M18.5 12h3M5.3 5.3l2.1 2.1M16.6 16.6l2.1 2.1M18.7 5.3l-2.1 2.1M7.4 16.6l-2.1 2.1"/>',
  plus: '<path d="M12 5v14M5 12h14"/>',
  trash: '<path d="M4 7h16M10 11v6M14 11v6M6 7l1 13h10l1-13M9 7V4h6v3"/>',
  edit: '<path d="M4 20h4L19 9l-4-4L4 16v4Z"/><path d="m13.5 6.5 4 4"/>',
  check: '<path d="m5 12.5 4.5 4.5L19 7.5"/>',
  x: '<path d="M6 6l12 12M18 6 6 18"/>',
  chevL: '<path d="m15 5-7 7 7 7"/>', chevR: '<path d="m9 5 7 7-7 7"/>',
  download: '<path d="M12 4v11M7 11l5 5 5-5M5 20h14"/>', upload: '<path d="M12 16V5M7 9l5-5 5 5M5 20h14"/>',
  list: '<path d="M8 6h12M8 12h12M8 18h12M4 6h.01M4 12h.01M4 18h.01"/>',
  pause: '<path d="M8 5v14M16 5v14"/>', clock: '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
};
const ic = (n, sz = 20) => `<svg class="ic" width="${sz}" height="${sz}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">${IC[n] || ''}</svg>`;
const NAV = [
  { id: 'home', t: 'ภาพรวม', i: 'home' }, { id: 'tx', t: 'รายรับ-รายจ่าย', i: 'swap' }, { id: 'bills', t: 'รายการต้องจ่าย', i: 'calendar' },
  { id: 'save', t: 'เงินเก็บ & แบบออมเงิน', i: 'coins', short: 'เงินเก็บ' }, { id: 'debt', t: 'หนี้สิน', i: 'card' }, { id: 'goals', t: 'เป้าหมาย', i: 'target' },
  { id: 'wish', t: 'ของที่อยากได้', i: 'heart' }, { id: 'budget', t: 'บริหารเงิน', i: 'sliders' }, { id: 'assess', t: 'ประเมินการเงิน', i: 'pulse' },
];
const PAGE_TITLE = Object.fromEntries([...NAV.map(n => [n.id, n.t]), ['settings', 'ตั้งค่าและข้อมูล']]);

const pageHead = (title, sub, actions = '') => `<div class="pagehead"><div><h1>${title}</h1>${sub ? `<p>${sub}</p>` : ''}</div><div class="head-actions">${actions}</div></div>`;
const empty = (title, text, actions = '') => `<div class="empty"><h3>${title}</h3><p>${text}</p><div class="btnrow">${actions}</div></div>`;
const monthNav = () => `<div class="monthnav"><button class="icon-btn" data-act="ym" data-d="-1" aria-label="เดือนก่อนหน้า">${ic('chevL')}</button><strong>${ymLabel(ui.ym)}</strong><button class="icon-btn" data-act="ym" data-d="1" aria-label="เดือนถัดไป">${ic('chevR')}</button>${ui.ym !== curYm() ? '<button class="btn ghost sm" data-act="ym-now">เดือนนี้</button>' : ''}</div>`;
const bar = (v, max, cls = '', lg = '') => `<div class="bar ${cls} ${lg}" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="${Math.round(clamp(max > 0 ? v / max * 100 : 0))}"><i style="width:${clamp(max > 0 ? v / max * 100 : 0)}%"></i></div>`;
const chip = (t, c = '') => `<span class="chip ${c}">${t}</span>`;
const iconBtn = (act, icon, label, data = '') => `<button class="icon-btn sm" data-act="${act}" ${data} aria-label="${label}" title="${label}">${ic(icon, 17)}</button>`;

function allocBar(p) {
  const segs = [['จ่ายไปแล้ว', p.spentTotal, 'var(--muted)'], ['บิลที่ยังไม่จ่าย', p.unpaidBills, 'var(--warn)'], ['ผ่อนหนี้ที่เหลือ', p.debtRemaining, 'var(--expense)'], ['กันไว้ออม', p.saveRemaining, 'var(--save)'], ['ใช้ได้', Math.max(0, p.left), 'var(--income)']].filter(s => s[1] > 0.5);
  const tot = sum(segs, s => s[1]) || 1;
  const label = segs.map(s => s[0] + ' ' + money(s[1])).join(', ');
  return `<div class="alloc" role="img" aria-label="${esc(label)}">${segs.map(s => `<i style="flex:${s[1] / tot};background:${s[2]}"></i>`).join('')}</div>
  <ul class="legend">${segs.map(s => `<li><span class="sw" style="background:${s[2]}"></span>${s[0]} <b>${money(s[1])}</b></li>`).join('')}</ul>`;
}

function gauge(score, grade) {
  const L = Math.PI * 80, col = score >= 65 ? 'var(--income)' : score >= 45 ? 'var(--warn)' : 'var(--expense)';
  return `<div class="gauge"><svg viewBox="0 0 200 118" role="img" aria-label="คะแนนสุขภาพการเงิน ${score} จาก 100">
    <path d="M20 100A80 80 0 0 1 180 100" fill="none" stroke="var(--surface-2)" stroke-width="16" stroke-linecap="round"/>
    <path d="M20 100A80 80 0 0 1 180 100" fill="none" stroke="${col}" stroke-width="16" stroke-linecap="round" stroke-dasharray="${L * score / 100} ${L}"/>
    <text x="100" y="96" text-anchor="middle" style="font:500 44px var(--display);fill:var(--ink)">${score}</text></svg>
    ${chip(grade[0], grade[1])}</div>`;
}

function barChart() {
  const months = [...Array(6)].map((_, i) => shiftYm(ui.ym, i - 5)), data = months.map(monthStats);
  const max = Math.max(1, ...data.map(d => Math.max(d.income, d.expense)));
  if (data.every(d => !d.income && !d.expense)) return '<p class="muted">ยังไม่มีข้อมูล 6 เดือนล่าสุด</p>';
  const W = 560, H = 210, pb = 28, pt = 10, gw = W / 6, y = v => pt + (H - pt - pb) * (1 - v / max);
  let s = `<svg viewBox="0 0 ${W} ${H}" width="100%" role="img" aria-label="รายรับและรายจ่ายย้อนหลัง 6 เดือน"><line x1="0" x2="${W}" y1="${H - pb}" y2="${H - pb}" stroke="var(--line)"/>`;
  data.forEach((d, i) => {
    const cx = gw * (i + .5), hi = (H - pb) - y(d.income), he = (H - pb) - y(d.expense);
    s += `<rect x="${cx - 24}" y="${y(d.income)}" width="22" height="${hi}" rx="3" style="fill:var(--income)"><title>${ymShort(months[i])} รายรับ ${money(d.income)}</title></rect>`;
    s += `<rect x="${cx + 2}" y="${y(d.expense)}" width="22" height="${he}" rx="3" style="fill:var(--expense)"><title>${ymShort(months[i])} รายจ่าย ${money(d.expense)}</title></rect>`;
    s += `<text x="${cx}" y="${H - 8}" text-anchor="middle" style="font:500 13px var(--font);fill:var(--muted)">${TH_M[+months[i].slice(5) - 1]}</text>`;
  });
  return s + '</svg>' + `<ul class="legend" style="margin-top:6px"><li><span class="sw" style="background:var(--income)"></span>รายรับ</li><li><span class="sw" style="background:var(--expense)"></span>รายจ่าย</li></ul>`;
}
function donut(byCat, total) {
  let ents = Object.entries(byCat).sort((a, b) => b[1] - a[1]);
  if (!ents.length) return '<p class="muted">ยังไม่มีรายจ่ายในเดือนนี้</p>';
  if (ents.length > 6) { const rest = sum(ents.slice(5), e => e[1]); ents = [...ents.slice(0, 5), ['__rest', rest]]; }
  const r = 54, C = 2 * Math.PI * r; let off = 0, arcs = '';
  ents.forEach(([k, v]) => {
    const c = k === '__rest' ? { color: '#8A949E', name: 'หมวดอื่นๆ รวม' } : catOf('expense', k); const len = v / total * C;
    arcs += `<circle cx="70" cy="70" r="${r}" fill="none" stroke="${c.color}" stroke-width="18" stroke-dasharray="${Math.max(0, len - (ents.length > 1 ? 1.5 : 0))} ${C}" stroke-dashoffset="${-off}" transform="rotate(-90 70 70)"><title>${c.name} ${money(v)}</title></circle>`; off += len;
  });
  const legend = ents.map(([k, v]) => { const c = k === '__rest' ? { color: '#8A949E', name: 'หมวดอื่นๆ รวม' } : catOf('expense', k); return `<li><span class="sw" style="background:${c.color}"></span><span style="flex:1">${c.name}</span><b>${money(v)}</b><span class="muted" style="width:42px;text-align:right">${pct(v / total)}</span></li>`; }).join('');
  return `<div style="display:grid;grid-template-columns:150px minmax(0,1fr);gap:16px;align-items:center"><svg viewBox="0 0 140 140" width="150" role="img" aria-label="สัดส่วนรายจ่ายตามหมวด"><circle cx="70" cy="70" r="${r}" fill="none" stroke="var(--surface-2)" stroke-width="18"/>${arcs}
  <text x="70" y="68" text-anchor="middle" style="font:500 15px var(--display);fill:var(--ink)">${money(total)}</text><text x="70" y="86" text-anchor="middle" style="font:400 11px var(--font);fill:var(--muted)">รายจ่ายรวม</text></svg>
  <ul class="legend" style="flex-direction:column;gap:6px;flex-wrap:nowrap">${legend}</ul></div>`;
}

/* ============ HOME ============ */
function heroHTML(pl, isNow) {
  if (pl.basis <= 0) return `<section class="card hero"><div class="hero-empty"><h2>วันนี้ใช้ได้อีกเท่าไหร่?</h2><p>บันทึกรายรับของเดือนนี้ หรือกำหนดรายได้ต่อเดือน แล้วแอพจะหักบิล ค่าผ่อนหนี้ และเงินออมให้ เหลือเป็นเงินที่ใช้ได้ต่อวัน</p><div class="btnrow"><button class="btn primary" data-act="tx-add" data-type="income">${ic('plus', 18)}บันทึกรายรับ</button><button class="btn" data-go="budget">กำหนดรายได้ต่อเดือน</button></div></div></section>`;
  let top;
  if (isNow) {
    const now = new Date(), dl = daysIn(now.getFullYear(), now.getMonth() + 1) - now.getDate() + 1;
    if (pl.left >= 0) top = `<div class="hero-label">วันนี้ใช้ได้อีก</div><div class="hero-num">${money(pl.left / dl)}<small>ต่อวัน</small></div><p class="hero-sub">เหลือ ${money(pl.left)} สำหรับอีก ${dl} วันของเดือนนี้ หลังกันบิล ค่าผ่อนหนี้ และเงินออมไว้แล้ว</p>`;
    else top = `<div class="hero-label">เดือนนี้เกินแผนอยู่</div><div class="hero-num exp">${money(pl.left)}</div><p class="hero-sub">เงินไม่พอสำหรับบิล ผ่อนหนี้ และเงินออมที่กันไว้ ลองลดรายจ่ายที่ไม่จำเป็น หรือปรับเปอร์เซ็นต์เงินออมในหน้าบริหารเงิน</p>`;
  } else top = `<div class="hero-label">สรุป${ymLabel(ui.ym)}</div><div class="hero-num ${pl.st.net < 0 ? 'exp' : ''}">${money(pl.st.net)}<small>รายรับ − รายจ่าย</small></div>`;
  return `<section class="card hero">${top}${isNow ? allocBar(pl) : ''}</section>`;
}
function pageHome() {
  const ym = ui.ym, isNow = ym === curYm(), pl = monthPlan(ym), st = pl.st;
  const greet = state.settings.name ? `สวัสดี ${esc(state.settings.name)}` : 'ภาพรวมการเงิน';
  const none = !state.tx.length && !state.bills.length && !state.pots.length && !state.debts.length;
  const billsNow = billsForMonth(curYm()).filter(i => !i.paid).slice(0, 5);
  const goals = state.goals.map(g => ({ g, s: goalSaved(g) })).filter(x => x.s < x.g.target).sort((a, b) => b.s / b.g.target - a.s / a.g.target).slice(0, 3);
  const A = assess(), debtTotal = sum(state.debts, d => d.balance), potTotal = potsTotal();
  const recent = [...state.tx].sort((a, b) => b.date.localeCompare(a.date) || 0).slice(0, 6);
  return pageHead(greet, '', monthNav() + `<button class="btn primary" data-act="tx-add">${ic('plus', 18)}บันทึกรายการ</button>`) +
    (none ? `<div class="card" style="margin-bottom:16px;display:flex;flex-wrap:wrap;gap:12px;align-items:center;justify-content:space-between"><div><b>เพิ่งเริ่มใช้ใช่ไหม</b><div class="muted">เริ่มบันทึกรายการแรก หรือโหลดข้อมูลตัวอย่างเพื่อดูว่าแอพทำงานอย่างไร (ลบทิ้งได้ในหน้าตั้งค่า)</div></div><button class="btn" data-act="demo">โหลดข้อมูลตัวอย่าง</button></div>` : '') +
    `<div class="stack">${heroHTML(pl, isNow)}
    <section class="card kpis" aria-label="สรุปเดือน ${ymLabel(ym)}"><div><span>รายรับ</span><b class="inc">${money(st.income)}</b></div><div><span>รายจ่าย</span><b class="exp">${money(st.expense)}</b></div><div><span>คงเหลือ</span><b class="${st.net < 0 ? 'exp' : ''}">${money(st.net)}</b></div><div><span>อัตราการออม</span><b>${st.rate === null ? '—' : pct(st.rate)}</b></div></section>
    <div class="grid-wide"><section class="card"><h2>รายรับ-รายจ่าย 6 เดือน</h2>${barChart()}</section><section class="card"><h2>รายจ่ายแยกหมวด</h2>${donut(st.byCat, st.expense)}</section></div>
    <div class="grid2">
      <section class="card"><div class="card-h"><span>บิลที่ต้องจ่ายเดือนนี้</span><button class="linkbtn" data-go="bills">ดูทั้งหมด</button></div>${billsNow.length ? `<ul class="list">${billsNow.map(it => { const s = billStatus(it); return `<li class="row" style="grid-template-columns:minmax(0,1fr) auto auto"><div class="row-main"><b>${esc(it.bill.name)}</b><small>ครบกำหนด ${fmtDate(it.date)}</small></div>${s === 'overdue' ? chip('เลยกำหนด', 'bad') : s === 'soon' ? chip('ใกล้ครบ', 'warn') : ''}<span class="amt">${money(it.bill.amount)}</span></li>`; }).join('')}</ul>` : `<p class="muted">${state.bills.length ? 'จ่ายครบแล้วทุกรายการ' : 'ยังไม่ได้ตั้งรายการต้องจ่าย เช่น ค่าเช่า ค่าไฟ ค่าอินเทอร์เน็ต'}</p>`}</section>
      <section class="card"><div class="card-h"><span>ความคืบหน้าเป้าหมาย</span><button class="linkbtn" data-go="goals">ดูทั้งหมด</button></div>${goals.length ? goals.map(x => `<div style="margin-bottom:14px"><div style="display:flex;justify-content:space-between;gap:10px"><b style="font-weight:500">${esc(x.g.name)}</b><span class="muted num">${pct(x.s / x.g.target)}</span></div>${bar(x.s, x.g.target, 'green')}<small class="muted">${money(x.s)} จาก ${money(x.g.target)}</small></div>`).join('') : '<p class="muted">ยังไม่มีเป้าหมายที่กำลังเก็บ</p>'}</section>
    </div>
    <div class="grid2">
      <section class="card"><div class="card-h"><span>ฐานะการเงิน</span><button class="linkbtn" data-go="save">เงินเก็บ</button></div><ul class="ledger"><li><span class="l">เงินเก็บทั้งหมด</span><span class="dots"></span><span class="v inc">${money(potTotal)}</span></li><li><span class="l">หนี้สินคงเหลือ</span><span class="dots"></span><span class="v exp">${money(debtTotal)}</span></li><li class="total"><span class="l">มั่งคั่งสุทธิ</span><span class="dots"></span><span class="v ${potTotal - debtTotal < 0 ? 'exp' : ''}">${money(potTotal - debtTotal)}</span></li></ul></section>
      <section class="card"><div class="card-h"><span>สุขภาพการเงิน</span><button class="linkbtn" data-go="assess">ดูรายละเอียด</button></div>${A && !A.noIncome ? `<div style="display:grid;grid-template-columns:minmax(0,170px) 1fr;gap:14px;align-items:center">${gauge(A.score, A.grade)}<div class="muted">${A.todo.length ? 'ควรเริ่มจาก<b style="display:block;color:var(--ink)">' + esc(A.todo[0].title) + '</b>' : 'ทุกด้านอยู่ในเกณฑ์ดี'}</div></div>` : '<p class="muted">บันทึกรายรับและรายจ่ายสัก 1 เดือน เพื่อให้แอพประเมินให้</p>'}</section>
    </div>
    <section class="card"><div class="card-h"><span>รายการล่าสุด</span><button class="linkbtn" data-go="tx">ดูทั้งหมด</button></div>${recent.length ? `<ul class="list">${recent.map(txRow).join('')}</ul>` : '<p class="muted">ยังไม่มีรายการ</p>'}</section></div>`;
}

/* ============ TRANSACTIONS ============ */
function txRow(t, actions = false) {
  const c = catOf(t.type, t.cat), inc = t.type === 'income', linked = t.billId ? 'จากรายการต้องจ่าย' : t.debtId ? 'จากการผ่อนหนี้' : '';
  return `<li class="row"><span class="dot" style="background:${c.color}"></span><div class="row-main"><b>${esc(t.note || c.name)}</b><small>${c.name}${actions ? '' : ' · ' + fmtDate(t.date)}${linked ? ' · ' + linked : ''}</small></div><span class="amt ${inc ? 'inc' : 'exp'}">${inc ? '+' : '−'}${moneyx(t.amount)}</span>${actions ? `<div class="row-actions">${linked ? '' : iconBtn('tx-edit', 'edit', 'แก้ไข', `data-id="${t.id}"`)}${iconBtn('tx-del', 'trash', 'ลบ', `data-id="${t.id}"`)}</div>` : '<span></span>'}</li>`;
}
function txListHTML() {
  const q = ui.q.trim().toLowerCase();
  let list = state.tx.filter(t => t.date.startsWith(ui.ym) && (ui.txType === 'all' || t.type === ui.txType) && (ui.txCat === 'all' || t.cat === ui.txCat) && (!q || (t.note || '').toLowerCase().includes(q) || catOf(t.type, t.cat).name.toLowerCase().includes(q)));
  if (!list.length) return state.tx.some(t => t.date.startsWith(ui.ym)) ? '<p class="muted" style="padding:24px 0;text-align:center">ไม่พบรายการที่ตรงกับตัวกรอง</p>'
    : empty('ยังไม่มีรายการในเดือนนี้', 'จดรายรับและรายจ่ายทุกครั้งที่เกิดขึ้น เดือนละไม่กี่นาทีก็เห็นภาพการเงินชัดขึ้น', `<button class="btn primary" data-act="tx-add">${ic('plus', 18)}บันทึกรายการแรก</button>${state.tx.length ? '' : '<button class="btn" data-act="demo">โหลดข้อมูลตัวอย่าง</button>'}`);
  list.sort((a, b) => b.date.localeCompare(a.date));
  const groups = {}; list.forEach(t => (groups[t.date] ||= []).push(t));
  return Object.keys(groups).sort().reverse().map(d => { const g = groups[d], net = sum(g, t => t.type === 'income' ? t.amount : -t.amount); return `<div class="dayhead"><span>${fmtDay(d)}</span><span class="num ${net < 0 ? 'exp' : 'inc'}">${net >= 0 ? '+' : '−'}${money(Math.abs(net))}</span></div><ul class="list">${g.map(t => txRow(t, true)).join('')}</ul>`; }).join('');
}
function pageTx() {
  const st = monthStats(ui.ym);
  const cats = [...CATS_EXP.map(c => [c.id, c.name]), ...CATS_INC.filter(c => c.id !== 'other').map(c => [c.id, c.name + ' (รับ)'])];
  return pageHead('รายรับ-รายจ่าย', 'จดทุกรายการเพื่อให้ภาพรวมและการประเมินแม่นยำ', monthNav() + `<button class="btn primary" data-act="tx-add">${ic('plus', 18)}บันทึกรายการ</button>`) +
    `<section class="card kpis" style="margin-bottom:16px"><div><span>รายรับ</span><b class="inc">${money(st.income)}</b></div><div><span>รายจ่าย</span><b class="exp">${money(st.expense)}</b></div><div><span>คงเหลือ</span><b class="${st.net < 0 ? 'exp' : ''}">${money(st.net)}</b></div><div><span>อัตราการออม</span><b>${st.rate === null ? '—' : pct(st.rate)}</b></div></section>
    <section class="card"><div class="filters"><div class="seg" role="group" aria-label="กรองประเภท">${[['all', 'ทั้งหมด'], ['income', 'รายรับ'], ['expense', 'รายจ่าย']].map(([v, t]) => `<label><input type="radio" name="txf" value="${v}" data-change="tx-filter" ${ui.txType === v ? 'checked' : ''}><span>${t}</span></label>`).join('')}</div>
    <select data-change="tx-cat" aria-label="กรองหมวดหมู่"><option value="all">ทุกหมวดหมู่</option>${cats.map(([v, t]) => `<option value="${v}" ${ui.txCat === v ? 'selected' : ''}>${t}</option>`).join('')}</select>
    <input type="search" data-input="tx-q" placeholder="ค้นหา เช่น กาแฟ" value="${esc(ui.q)}" aria-label="ค้นหารายการ"></div><div id="txlist">${txListHTML()}</div></section>`;
}

/* ============ BILLS ============ */
const freqText = b => b.freq === 'monthly' ? `ทุกเดือน วันที่ ${b.dueDay}` : b.freq === 'yearly' ? `ทุกปี ${b.dueDay} ${TH_M[(b.dueMonth || 1) - 1]}` : `ครั้งเดียว ${b.dueDate ? fmtDate(b.dueDate) : ''}`;
function pageBills() {
  const items = billsForMonth(ui.ym), total = sum(items, i => i.bill.amount), paid = sum(items.filter(i => i.paid), i => i.bill.amount);
  const monthlyAvg = sum(state.bills.filter(b => b.active !== false), b => b.freq === 'monthly' ? b.amount : b.freq === 'yearly' ? b.amount / 12 : 0);
  const odd = state.bills.filter(b => b.active === false);
  return pageHead('รายการต้องจ่าย', 'บิลและค่าใช้จ่ายประจำ ติ๊กเมื่อจ่ายแล้ว ระบบจะบันทึกเป็นรายจ่ายให้อัตโนมัติ', monthNav() + `<button class="btn primary" data-act="bill-add">${ic('plus', 18)}เพิ่มรายการ</button>`) +
    `<div class="stack"><section class="card"><div style="display:flex;flex-wrap:wrap;justify-content:space-between;gap:10px;margin-bottom:10px"><div><span class="muted">จ่ายแล้ว</span><div class="big">${money(paid)} <span class="muted" style="font-size:16px">จาก ${money(total)}</span></div></div><div style="text-align:right"><span class="muted">ยังต้องจ่าย</span><div class="big ${total - paid > 0 ? 'wrn' : 'inc'}">${money(total - paid)}</div></div></div>${bar(paid, total, 'green', 'lg')}${monthlyAvg > 0 ? `<small class="muted" style="display:block;margin-top:10px">ภาระประจำเฉลี่ยเดือนละ ${money(monthlyAvg)} (รวมรายปีหารเฉลี่ยแล้ว)</small>` : ''}</section>
    <section class="card"><h2>รายการของ${ymLabel(ui.ym)}</h2>${items.length ? `<ul class="list">${items.map(it => { const s = billStatus(it), d = parseD(it.date); return `<li class="row" style="grid-template-columns:auto minmax(0,1fr) auto auto"><div class="daybadge ${s === 'paid' ? 'paid' : s === 'overdue' ? 'late' : ''}">${d.getDate()}<small>${TH_M[d.getMonth()]}</small></div><div class="row-main"><b>${esc(it.bill.name)}</b><small>${catOf('expense', it.bill.cat).name} · ${s === 'overdue' ? 'เลยกำหนดแล้ว' : s === 'soon' ? 'ใกล้ครบกำหนด' : s === 'paid' ? 'จ่ายแล้ว' : freqText(it.bill)}</small></div><span class="amt">${moneyx(it.bill.amount)}</span><button class="check ${it.paid ? 'on' : ''}" data-act="bill-toggle" data-id="${it.bill.id}" aria-pressed="${it.paid}">${ic('check', 16)}${it.paid ? 'จ่ายแล้ว' : 'จ่ายแล้ว?'}</button></li>`; }).join('')}</ul>` : empty('ไม่มีรายการต้องจ่ายในเดือนนี้', state.bills.length ? 'รายการที่ตั้งไว้ไม่ตรงกับเดือนนี้' : 'ตั้งค่าเช่า ค่าไฟ ค่าน้ำ ค่าอินเทอร์เน็ต ค่าสมาชิกต่างๆ ไว้ แล้วดูได้ว่าเดือนนี้เหลือต้องจ่ายอะไรบ้าง', `<button class="btn primary" data-act="bill-add">${ic('plus', 18)}เพิ่มรายการต้องจ่าย</button>`)}</section>
    ${state.bills.length ? `<section class="card"><h2>รายการที่ตั้งไว้ทั้งหมด</h2><ul class="list">${state.bills.map(b => `<li class="row" style="grid-template-columns:minmax(0,1fr) auto auto"><div class="row-main"><b>${esc(b.name)} ${b.active === false ? chip('พักไว้') : ''}</b><small>${freqText(b)} · ${catOf('expense', b.cat).name}</small></div><span class="amt">${moneyx(b.amount)}</span><div class="row-actions">${iconBtn('bill-pause', b.active === false ? 'check' : 'pause', b.active === false ? 'เปิดใช้งาน' : 'พักรายการ', `data-id="${b.id}"`)}${iconBtn('bill-edit', 'edit', 'แก้ไข', `data-id="${b.id}"`)}${iconBtn('bill-del', 'trash', 'ลบ', `data-id="${b.id}"`)}</div></li>`).join('')}</ul></section>` : ''}</div>`;
}

/* ============ SAVINGS ============ */
function pageSave() {
  const tabs = `<div class="tabs" role="tablist"><button class="tab" role="tab" data-act="tab" data-t="pots" aria-selected="${ui.saveTab === 'pots'}">กระปุกเงินเก็บ</button><button class="tab" role="tab" data-act="tab" data-t="plans" aria-selected="${ui.saveTab === 'plans'}">แบบออมเงิน</button></div>`;
  const act = ui.saveTab === 'pots' ? `<button class="btn primary" data-act="pot-add">${ic('plus', 18)}สร้างกระปุก</button>` : `<button class="btn primary" data-act="plan-add">${ic('plus', 18)}สร้างแบบออมเงิน</button>`;
  return pageHead('เงินเก็บ & แบบออมเงิน', 'แยกเงินเก็บเป็นกระปุกตามวัตถุประสงค์ และเลือกแบบออมที่เหมาะกับนิสัยของคุณ', tabs + act) + (ui.saveTab === 'pots' ? potsView() : plansView());
}
function potsView() {
  if (!state.pots.length) return empty('ยังไม่มีกระปุกเงินเก็บ', 'เริ่มจากกระปุกเงินสำรองฉุกเฉิน แล้วค่อยแยกกระปุกอื่นๆ ตามเป้าหมาย เช่น เที่ยว ซื้อของใหญ่ ดาวน์บ้าน', `<button class="btn primary" data-act="pot-preset">สร้างกระปุกเงินสำรองฉุกเฉิน</button><button class="btn" data-act="pot-add">สร้างกระปุกอื่น</button>`);
  const total = potsTotal(), av = avgBasis();
  return `<div class="stack"><section class="card" style="display:flex;flex-wrap:wrap;gap:14px 40px;align-items:center"><div><span class="muted">เงินเก็บทั้งหมด</span><div class="big sav">${money(total)}</div></div>${av.expense > 0 ? `<div><span class="muted">ใช้ชีวิตได้นาน (ตามรายจ่ายเฉลี่ย)</span><div class="big">${(total / av.expense).toFixed(1)} เดือน</div></div>` : ''}<div><span class="muted">ออมแล้วเดือนนี้</span><div class="big">${money(savedInMonth(curYm()))}</div></div></section>
  <div class="grid3">${state.pots.map(p => { const b = potBal(p); return `<section class="card pot"><div class="pot-top"><div><h3>${esc(p.name)}</h3>${p.kind === 'emergency' ? chip('เงินสำรองฉุกเฉิน', 'sv') : ''}</div>${iconBtn('pot-edit', 'edit', 'แก้ไข', `data-id="${p.id}"`)}</div><div class="big">${money(b)}</div>${p.target > 0 ? `${bar(b, p.target, 'purple')}<div class="meta"><span>เป้า ${money(p.target)}</span><span>${pct(clamp(b / p.target * 100, 0, 100) / 100)}${b >= p.target ? ' · ครบแล้ว' : ' · ขาดอีก ' + money(p.target - b)}</span></div>` : '<div class="meta"><span>ไม่ได้ตั้งยอดเป้าหมาย</span></div>'}<div class="card-actions"><button class="btn sm primary" data-act="pot-dep" data-id="${p.id}">ฝาก</button><button class="btn sm" data-act="pot-wd" data-id="${p.id}">ถอน</button><button class="btn sm ghost" data-act="pot-hist" data-id="${p.id}">${ic('list', 16)}ประวัติ</button><button class="btn sm ghost danger" data-act="pot-del" data-id="${p.id}">ลบ</button></div></section>`; }).join('')}</div></div>`;
}
const PLAN_KIND = { week52: 'ออม 52 สัปดาห์', weekly: 'ออมรายสัปดาห์', monthly: 'ออมรายเดือน', daily: 'ท้าทายรายวัน', percent: 'ออมเป็น % ของรายได้' };
function plansView() {
  const tpl = `<div class="tpl">${[['week52', 'ออม 52 สัปดาห์', 'สัปดาห์แรกออมน้อย แล้วเพิ่มทีละขั้นจนครบปี เหมาะกับคนอยากสร้างนิสัย'], ['monthly', 'ออมรายเดือนเท่าๆ กัน', 'ตั้งยอดคงที่ทุกเดือน ง่ายและสม่ำเสมอ'], ['weekly', 'ออมรายสัปดาห์', 'ยอดเท่ากันทุกสัปดาห์ เหมาะกับรายได้รายวัน/รายสัปดาห์'], ['daily', 'ท้าทายรายวัน (30–100 วัน)', 'ออมวันละนิดเป็นชาเลนจ์สั้นๆ'], ['percent', 'ออมเป็น % ของรายได้', 'กันเงินตามสัดส่วนรายได้ทุกเดือน เช่น 15%']].map(([k, t, d]) => `<button data-act="plan-add" data-kind="${k}"><b>${t}</b><span>${d}</span></button>`).join('')}</div>`;
  if (!state.plans.length) return `<section class="card"><h2>เลือกแบบออมเงินที่เหมาะกับคุณ</h2>${tpl}</section>`;
  return `<div class="stack">${state.plans.map(pl => {
    const sv = planSaved(pl), tot = planTotal(pl), exp = planExpected(pl), done = pl.steps.filter(s => s.done).length, behind = Math.max(0, exp - done), pot = state.pots.find(p => p.id === pl.potId);
    const nextIdx = pl.steps.findIndex(s => !s.done), short = ['week52', 'weekly', 'daily'].includes(pl.kind);
    return `<section class="card item"><div class="pot-top"><div><h3>${esc(pl.name)}</h3><div class="meta"><span>${PLAN_KIND[pl.kind]}</span><span>เริ่ม ${fmtDate(pl.start)}</span><span>${pot ? 'ฝากเข้า ' + esc(pot.name) : 'ไม่ผูกกระปุก'}</span></div></div><div style="text-align:right"><div class="big sav">${money(sv)}</div><small class="muted">จาก ${money(tot)}</small></div></div>${bar(sv, tot, 'purple')}
    <div style="display:flex;flex-wrap:wrap;gap:8px;align-items:center">${done >= pl.steps.length ? chip('ครบแผนแล้ว', 'ok') : behind > 0 ? chip(`ตามหลัง ${behind} งวด`, 'bad') : exp > 0 ? chip('ตามแผน', 'ok') : chip('ยังไม่เริ่ม', 'info')}<small class="muted">ทำแล้ว ${done}/${pl.steps.length} งวด · แตะที่ช่องเพื่อติ๊กว่าออมแล้ว</small></div>
    <div class="steps">${pl.steps.map((s, i) => `<button class="step ${s.done ? 'done' : i < exp ? 'late' : ''} ${i === nextIdx ? 'next' : ''}" data-act="step" data-id="${pl.id}" data-i="${i}" aria-pressed="${!!s.done}" aria-label="${esc(s.label)} ${money(s.amount)} ${s.done ? 'ออมแล้ว' : 'ยังไม่ได้ออม'}"><span>${short ? i + 1 : esc(s.label)}</span><b>${nf0.format(s.amount)}</b></button>`).join('')}</div>
    <div class="card-actions"><button class="btn sm ghost danger" data-act="plan-del" data-id="${pl.id}">${ic('trash', 16)}ลบแผนนี้</button></div></section>`; }).join('')}
  <section class="card"><h2>เพิ่มแบบออมเงินอื่น</h2>${tpl}</section></div>`;
}

/* ============ DEBTS ============ */
function pageDebt() {
  const act = state.debts.filter(d => d.balance > 0.005), total = sum(state.debts, d => d.balance), minTotal = sum(act, d => d.minPay || 0), inc = expectedIncome();
  const wRate = total > 0 ? sum(act, d => d.balance * (d.rate || 0)) / total : 0;
  let html = pageHead('หนี้สิน', 'ติดตามยอดคงเหลือ ดอกเบี้ย และวางแผนปิดหนี้ให้เร็วที่สุด', `<button class="btn primary" data-act="debt-add">${ic('plus', 18)}เพิ่มหนี้</button>`);
  if (!state.debts.length) return html + empty('ยังไม่มีหนี้สิน', 'ถ้ามีบัตรเครดิต ผ่อนรถ ผ่อนมือถือ หรือกู้เรียน ลองเพิ่มไว้ แอพจะคำนวณว่าปิดหนี้ได้เมื่อไหร่ และควรปิดตัวไหนก่อน', `<button class="btn primary" data-act="debt-add">${ic('plus', 18)}เพิ่มหนี้แรก</button>`);
  html += `<div class="stack"><section class="card kpis"><div><span>หนี้คงเหลือรวม</span><b class="exp">${money(total)}</b></div><div><span>ผ่อนขั้นต่ำต่อเดือน</span><b>${money(minTotal)}</b></div><div><span>ดอกเบี้ยเฉลี่ย</span><b>${wRate.toFixed(1)}%<small class="muted" style="font-size:14px"> ต่อปี</small></b></div><div><span>ภาระต่อรายได้</span><b class="${inc > 0 && minTotal / inc > .35 ? 'exp' : ''}">${inc > 0 ? pct(minTotal / inc) : '—'}</b></div></section>`;
  html += `<div class="grid3">${state.debts.map(d => {
    const paidPct = d.principal > 0 ? clamp((1 - d.balance / d.principal) * 100, 0, 100) : 0, po = payoffInfo(d.balance, d.rate || 0, d.minPay || 0), cleared = d.balance <= 0.005;
    let est = ''; if (!cleared) { if (!d.minPay) est = '<span class="wrn">ยังไม่ได้ระบุยอดผ่อนต่อเดือน</span>'; else if (po.months === Infinity) est = '<span class="exp">ยอดผ่อนไม่พอครอบคลุมดอกเบี้ย หนี้จะไม่ลดลง</span>'; else { const end = shiftYm(curYm(), po.months); est = `ปิดหนี้ในอีก <b>${po.months}</b> เดือน (ราว ${ymShort(end)})${po.interest > 1 ? ` · ดอกเบี้ยรวมประมาณ ${money(po.interest)}` : ''}`; } }
    return `<section class="card item"><div class="pot-top"><div><h3>${esc(d.name)}</h3><div class="meta"><span>${esc(d.type)}</span>${d.dueDay ? `<span>ครบกำหนดวันที่ ${d.dueDay}</span>` : ''}</div></div>${cleared ? chip('ปลอดหนี้แล้ว', 'ok') : iconBtn('debt-edit', 'edit', 'แก้ไข', `data-id="${d.id}"`)}</div><div class="big ${cleared ? 'inc' : 'exp'}">${money(d.balance)}</div>${bar(paidPct, 100, 'green')}<div class="meta"><span>จ่ายไปแล้ว ${paidPct.toFixed(0)}%</span><span>ดอกเบี้ย ${d.rate || 0}% ต่อปี</span><span>ผ่อนเดือนละ ${money(d.minPay || 0)}</span></div>${est ? `<div style="font-size:14.5px">${est}</div>` : ''}<div class="card-actions">${cleared ? '' : `<button class="btn sm primary" data-act="debt-pay" data-id="${d.id}">บันทึกการชำระ</button>`}<button class="btn sm ghost" data-act="debt-hist" data-id="${d.id}">${ic('list', 16)}ประวัติ</button>${cleared ? iconBtn('debt-edit', 'edit', 'แก้ไข', `data-id="${d.id}"`) : ''}<button class="btn sm ghost danger" data-act="debt-del" data-id="${d.id}">ลบ</button></div></section>`; }).join('')}</div>`;
  if (act.length) {
    const base = simulateDebts(act, 0, 'avalanche'), av = simulateDebts(act, ui.extra, 'avalanche'), sn = simulateDebts(act, ui.extra, 'snowball');
    const bestKey = av.interest <= sn.interest ? 'av' : 'sn';
    const cell = (r, t, d, key) => `<div class="${bestKey === key ? 'best' : ''}"><h4>${t} ${bestKey === key ? chip('ประหยัดกว่า', 'ok') : ''}</h4><div class="muted" style="font-size:13.5px;margin-bottom:6px">${d}</div>${r.months === Infinity ? '<b class="exp">ไม่สามารถปิดหนี้ได้ด้วยงบนี้</b>' : `ปิดหนี้หมดใน <b>${r.months}</b> เดือน<br>ดอกเบี้ยรวม <b>${money(r.interest)}</b>${base.months !== Infinity && base.interest > r.interest + 1 ? `<br><span class="inc">ประหยัดดอกเบี้ย ${money(base.interest - r.interest)}</span>` : ''}<ol class="order">${r.order.map(o => `<li>${esc(o.name)} <span>(เดือนที่ ${o.at})</span></li>`).join('')}</ol>`}</div>`;
    html += `<section class="card"><h2>วางแผนปิดหนี้</h2><p class="muted" style="margin-bottom:12px">ใส่เงินที่พอจ่ายเพิ่มต่อเดือนนอกเหนือจากยอดผ่อนขั้นต่ำ แล้วเทียบสองวิธีว่าแบบไหนปิดหนี้เร็วและเสียดอกเบี้ยน้อยกว่า</p><div class="fld" style="max-width:320px"><label for="extra">จ่ายเพิ่มต่อเดือน (บาท)</label><input id="extra" type="number" inputmode="decimal" min="0" step="any" value="${ui.extra || ''}" placeholder="0" data-change="extra"></div><div class="compare">${cell(av, 'ดอกเบี้ยสูงสุดก่อน', 'โปะหนี้ที่ดอกเบี้ยสูงสุดก่อน ประหยัดดอกเบี้ยมากที่สุด', 'av')}${cell(sn, 'ยอดน้อยสุดก่อน', 'ปิดก้อนเล็กให้หมดเร็ว ได้กำลังใจ แล้วต่อก้อนใหญ่', 'sn')}</div></section>`;
  }
  return html + '</div>';
}

/* ============ GOALS ============ */
function pageGoals() {
  const head = pageHead('เป้าหมาย', 'ตั้งเป้าหมายการเงิน แล้วดูว่าต้องเก็บเดือนละเท่าไหร่ถึงจะทัน', `<button class="btn primary" data-act="goal-add">${ic('plus', 18)}ตั้งเป้าหมาย</button>`);
  if (!state.goals.length) return head + empty('ยังไม่มีเป้าหมาย', 'เช่น เที่ยวต่างประเทศ ดาวน์รถ เงินก้อนแต่งงาน หรือเงินเกษียณ ตั้งยอดและวันที่อยากได้ แอพจะคำนวณยอดออมต่อเดือนให้', `<button class="btn primary" data-act="goal-add">${ic('plus', 18)}ตั้งเป้าหมายแรก</button>`);
  const av = avgBasis(), surplus = Math.max(0, av.income - av.expense);
  return head + `<div class="grid3">${state.goals.map(g => {
    const s = goalSaved(g), done = s >= g.target, rem = Math.max(0, g.target - s), pot = goalPot(g);
    let line = '', status = '';
    if (done) status = chip('สำเร็จแล้ว', 'ok');
    else if (g.deadline) { const ml = monthsBetween(today(), g.deadline) + (parseD(g.deadline).getDate() >= new Date().getDate() ? 0 : -1); if (g.deadline < today()) { status = chip('เลยกำหนด', 'bad'); line = `ยังขาด ${money(rem)}`; } else { const m = Math.max(1, ml), need = rem / m; line = `เหลือ ${m} เดือน ต้องออมเดือนละ <b>${money(need)}</b>`; status = surplus > 0 ? (need <= surplus ? chip('ทำได้ตามรายได้ปัจจุบัน', 'ok') : chip('เกินกว่าเงินเหลือเฉลี่ย', 'warn')) : ''; } }
    return `<section class="card item"><div class="pot-top"><div><h3>${esc(g.name)}</h3><div class="meta">${g.deadline ? `<span>กำหนด ${fmtDate(g.deadline)}</span>` : '<span>ไม่กำหนดวันที่</span>'}${pot ? `<span>ผูกกับ ${esc(pot.name)}</span>` : ''}</div></div>${iconBtn('goal-edit', 'edit', 'แก้ไข', `data-id="${g.id}"`)}</div>
    <div><span class="big">${money(s)}</span> <span class="muted">จาก ${money(g.target)}</span></div>${bar(s, g.target, done ? 'green' : '', 'lg')}<div class="meta"><span>${pct(clamp(s / g.target * 100) / 100)}</span>${!done ? `<span>ขาดอีก ${money(rem)}</span>` : ''}</div>${line ? `<div>${line}</div>` : ''}${status ? `<div>${status}</div>` : ''}${g.note ? `<small class="muted">${esc(g.note)}</small>` : ''}
    <div class="card-actions">${done ? '' : `<button class="btn sm primary" data-act="goal-dep" data-id="${g.id}">เพิ่มเงิน</button>`}${pot ? '' : `<button class="btn sm ghost" data-act="goal-hist" data-id="${g.id}">${ic('list', 16)}ประวัติ</button>`}<button class="btn sm ghost danger" data-act="goal-del" data-id="${g.id}">ลบ</button></div></section>`; }).join('')}</div>`;
}

/* ============ WISHLIST ============ */
const PRI = { 3: ['อยากมาก', 'bad'], 2: ['อยากพอควร', 'warn'], 1: ['อยากได้เฉยๆ', ''] };
function pageWish() {
  const head = pageHead('ของที่อยากได้', 'จดไว้ก่อน รอ 30 วันแล้วค่อยตัดสินใจ ช่วยลดการซื้อตามอารมณ์', `<button class="btn primary" data-act="wish-add">${ic('plus', 18)}เพิ่มของที่อยากได้</button>`);
  const want = state.wishes.filter(w => w.status !== 'bought').sort((a, b) => b.priority - a.priority || a.price - b.price), bought = state.wishes.filter(w => w.status === 'bought');
  if (!state.wishes.length) return head + empty('ยังไม่มีของที่อยากได้', 'เห็นของที่อยากได้ ให้มาจดไว้ที่นี่ก่อน แอพจะบอกว่าต้องเก็บกี่เดือน และเตือนให้รอครบ 30 วันก่อนตัดสินใจ', `<button class="btn primary" data-act="wish-add">${ic('plus', 18)}เพิ่มชิ้นแรก</button>`);
  const av = avgBasis(), surplus = Math.max(0, av.income - av.expense), totalPrice = sum(want, w => w.price);
  return head + `<div class="stack">${want.length ? `<section class="card kpis" style="grid-template-columns:repeat(3,minmax(0,1fr))"><div><span>จำนวนที่อยากได้</span><b>${want.length} ชิ้น</b></div><div><span>ราคารวม</span><b>${money(totalPrice)}</b></div><div><span>ใช้เวลาเก็บรวม</span><b>${surplus > 0 ? Math.ceil(totalPrice / surplus) + ' เดือน' : '—'}</b></div></section>` : ''}
  <div class="grid3">${want.map(w => {
    const days = dayDiff(w.added, today()), wait = Math.max(0, 30 - days), mo = surplus > 0 ? Math.ceil(w.price / surplus) : null;
    return `<section class="card item"><div class="pot-top"><div><h3>${esc(w.name)}</h3>${chip(PRI[w.priority][0], PRI[w.priority][1])}</div>${iconBtn('wish-edit', 'edit', 'แก้ไข', `data-id="${w.id}"`)}</div><div class="big">${money(w.price)}</div>
    <div>${bar(clamp(days, 0, 30), 30, wait ? 'amber' : 'green')}<small class="muted">${wait ? `รอมาแล้ว ${days} วัน เหลืออีก ${wait} วันถึงครบกฎ 30 วัน` : `ครบ 30 วันแล้ว ถ้ายังอยากได้อยู่ ถือว่าคิดมาดีแล้ว`}</small></div>
    <div class="meta">${mo ? `<span>เก็บจากเงินเหลือเฉลี่ย ≈ ${mo} เดือน</span>` : '<span>ยังคำนวณเวลาเก็บไม่ได้</span>'}</div>${w.note ? `<small class="muted">${esc(w.note)}</small>` : ''}
    <div class="card-actions"><button class="btn sm primary" data-act="wish-buy" data-id="${w.id}">ซื้อแล้ว</button><button class="btn sm" data-act="wish-goal" data-id="${w.id}">ตั้งเป็นเป้าหมาย</button><button class="btn sm ghost danger" data-act="wish-del" data-id="${w.id}">ลบ</button></div></section>`; }).join('')}</div>
  ${bought.length ? `<section class="card"><div class="card-h"><span>ซื้อแล้ว (${bought.length})</span><button class="linkbtn" data-act="wish-show">${ui.showBought ? 'ซ่อน' : 'แสดง'}</button></div>${ui.showBought ? `<ul class="list">${bought.map(w => `<li class="row" style="grid-template-columns:minmax(0,1fr) auto auto"><div class="row-main"><b>${esc(w.name)}</b><small>ซื้อเมื่อ ${w.boughtDate ? fmtDate(w.boughtDate) : ''}</small></div><span class="amt">${money(w.price)}</span>${iconBtn('wish-del', 'trash', 'ลบ', `data-id="${w.id}"`)}</li>`).join('')}</ul>` : ''}</section>` : ''}</div>`;
}

/* ============ BUDGET MANAGEMENT ============ */
const RATIO_PRESETS = { '50,30,20': 'สมดุล 50/30/20', '60,20,20': 'เน้นจำเป็น 60/20/20', '50,20,30': 'เน้นออม 50/20/30', '70,20,10': 'ภาระหนัก 70/20/10' };
function catBudgetRow(c, spent, limit) {
  const ratio = limit > 0 ? spent / limit : 0, cls = limit <= 0 ? '' : ratio > 1 ? 'red' : ratio >= .8 ? 'amber' : 'green';
  return `<div class="catrow" id="cb_${c.id}"><div class="nm"><span class="dot" style="background:${c.color}"></span>${c.name}</div><div class="inline-in sm"><input type="number" inputmode="decimal" min="0" step="any" value="${limit || ''}" placeholder="ไม่จำกัด" data-change="cat-limit" data-cat="${c.id}" aria-label="งบ ${c.name}"></div>${limit > 0 ? bar(spent, limit, cls) : '<span></span>'}<div class="st">${limit > 0 ? (ratio > 1 ? `<span class="exp">เกิน ${money(spent - limit)}</span>` : `เหลือ ${money(limit - spent)}`) : `ใช้ ${money(spent)}`}</div></div>`;
}
function cbSummary(st) {
  const b = state.settings.budgets, tb = sum(CATS_EXP, c => b[c.id] || 0), ts = sum(CATS_EXP.filter(c => b[c.id] > 0), c => st.byCat[c.id] || 0);
  return tb > 0 ? `<p style="margin-bottom:6px">รวมงบ <b>${money(tb)}</b> · ใช้ไป <b class="${ts > tb ? 'exp' : ''}">${money(ts)}</b> (เฉพาะหมวดที่ตั้งงบ)</p>` : '<p class="muted" style="margin-bottom:6px">ใส่งบสูงสุดที่ยอมใช้ในแต่ละหมวดต่อเดือน ระบบจะเตือนเมื่อใกล้ถึงและเมื่อเกิน</p>';
}
function pageBudget() {
  const ym = ui.ym, pl = monthPlan(ym), st = pl.st, s = state.settings, R = s.ratio, flexLeft = pl.flexBudget - pl.flexSpent;
  const now = new Date(), dl = ym === curYm() ? daysIn(now.getFullYear(), now.getMonth() + 1) - now.getDate() + 1 : 0;
  const rKey = R.join(',');
  const rows = [['จำเป็น', R[0], st.need, 'need'], ['อยากได้/ใช้ตามใจ', R[1], st.want, 'want']];
  const L = (l, v, cls = '', tot = '') => `<li class="${tot}"><span class="l">${l}</span><span class="dots"></span><span class="v ${cls}">${v}</span></li>`;
  return pageHead('บริหารเงิน', 'วางแผนว่ารายได้แต่ละเดือนจะไปอยู่ตรงไหน แล้วคุมให้อยู่ในงบ', monthNav()) +
    `<div class="stack"><section class="card"><h2>แผนเงินเดือนนี้ ไล่จากบนลงล่าง</h2><div class="grid2" style="margin-bottom:6px"><div class="fld"><label for="bi">รายได้ต่อเดือนที่ใช้วางแผน (บาท)</label><input id="bi" type="number" inputmode="decimal" min="0" step="any" value="${s.baseIncome || ''}" placeholder="${expectedIncome() ? 'เฉลี่ยจากข้อมูล ' + nf0.format(Math.round(expectedIncome())) : 'เช่น 30000'}" data-change="base-income"><small class="hint">เว้นว่างไว้ แอพจะใช้ค่าเฉลี่ยรายรับย้อนหลังให้</small></div><div class="fld"><label for="sp">กันเงินออมไว้ทุกเดือน (% ของรายได้)</label><input id="sp" type="number" inputmode="decimal" min="0" max="100" step="any" value="${s.savePct}" data-change="save-pct"><small class="hint">แนะนำ 10–20% เพื่อจ่ายตัวเองก่อนใช้จ่าย</small></div></div>
    ${pl.basis > 0 ? `<ul class="ledger">${L('รายได้ที่ใช้วางแผน', money(pl.basis), 'inc')}${L('หัก บิลและรายการต้องจ่าย', '−' + money(pl.billsTotal))}${L('หัก ผ่อนหนี้ขั้นต่ำ', '−' + money(pl.debtMin))}${L(`หัก เงินออม ${s.savePct}%`, '−' + money(pl.saveTarget), 'sav')}${L('งบใช้จ่ายอื่นๆ ทั้งเดือน', money(pl.flexBudget), pl.flexBudget < 0 ? 'exp' : '', 'total')}</ul>
    <div style="margin-top:14px">${pl.flexBudget > 0 ? bar(pl.flexSpent, pl.flexBudget, pl.flexSpent > pl.flexBudget ? 'red' : pl.flexSpent > pl.flexBudget * .8 ? 'amber' : 'green', 'lg') : ''}<p style="margin-top:8px">${pl.flexBudget <= 0 ? '<span class="exp">รายได้ไม่พอสำหรับบิล ผ่อนหนี้ และเงินออมที่กันไว้ ลองลดเปอร์เซ็นต์ออมชั่วคราว หรือเพิ่มรายได้ที่คาดไว้</span>' : `ใช้ไปแล้ว <b>${money(pl.flexSpent)}</b> จากงบ ${money(pl.flexBudget)} · ${flexLeft >= 0 ? `เหลือ <b class="inc">${money(flexLeft)}</b>${dl ? ` (วันละ ${money(flexLeft / dl)})` : ''}` : `<b class="exp">เกินงบ ${money(-flexLeft)}</b>`}`}</p></div>` : '<p class="muted">ใส่รายได้ต่อเดือนด้านบน หรือบันทึกรายรับ เพื่อให้แอพคำนวณแผนให้</p>'}</section>
    <section class="card"><h2>กฎแบ่งรายได้ จำเป็น / ตามใจ / ออม</h2><div class="fld" style="max-width:360px"><label for="rp">รูปแบบ</label><select id="rp" data-change="ratio-preset">${Object.entries(RATIO_PRESETS).map(([k, t]) => `<option value="${k}" ${rKey === k ? 'selected' : ''}>${t}</option>`).join('')}${RATIO_PRESETS[rKey] ? '' : `<option value="${rKey}" selected>กำหนดเอง ${R.join('/')}</option>`}</select></div>
    ${pl.basis > 0 ? `${rows.map(([n, p, act]) => { const tg = pl.basis * p / 100; return `<div style="margin-bottom:16px"><div style="display:flex;justify-content:space-between;gap:8px;flex-wrap:wrap"><b style="font-weight:600">${n} ${p}%</b><span class="num">ใช้ ${money(act)} จากงบ ${money(tg)}</span></div>${bar(act, tg, act > tg ? 'red' : act > tg * .85 ? 'amber' : 'green')}</div>`; }).join('')}<div><div style="display:flex;justify-content:space-between;gap:8px;flex-wrap:wrap"><b style="font-weight:600">ออม ${R[2]}%</b><span class="num">ออมแล้ว ${money(pl.savedSoFar)} จากเป้า ${money(pl.basis * R[2] / 100)}</span></div>${bar(pl.savedSoFar, pl.basis * R[2] / 100, 'purple')}</div>` : '<p class="muted">รอข้อมูลรายได้</p>'}
    <small class="hint" style="display:block;margin-top:12px">หมวดจำเป็น ได้แก่ อาหาร เดินทาง ที่อยู่ น้ำไฟ สุขภาพ ประกัน ครอบครัว การศึกษา และผ่อนหนี้ ส่วนกินนอกบ้าน ช้อปปิ้ง บันเทิง นับเป็นตามใจ</small></section>
    <section class="card"><div class="card-h"><span>งบรายหมวด</span><span class="btnrow"><button class="btn sm" data-act="budget-auto">ตั้งจากค่าเฉลี่ยย้อนหลัง</button><button class="btn sm ghost" data-act="budget-clear">ล้างงบ</button></span></div>
    <div id="cbsum">${cbSummary(st)}</div>
    ${CATS_EXP.map(c => catBudgetRow(c, st.byCat[c.id] || 0, s.budgets[c.id] || 0)).join('')}</section></div>`;
}

/* ============ ASSESSMENT ============ */
function pageAssess() {
  const head = pageHead('ประเมินการเงิน', 'ให้คะแนนสุขภาพการเงินจากข้อมูลที่คุณบันทึก พร้อมบอกว่าควรแก้อะไรก่อน');
  const A = assess();
  if (!A) return head + empty('ยังประเมินไม่ได้', 'ต้องมีรายรับและรายจ่ายอย่างน้อย 1 เดือน จึงจะคำนวณอัตราการออมและภาระหนี้ได้', `<button class="btn primary" data-act="tx-add">${ic('plus', 18)}บันทึกรายการ</button><button class="btn" data-act="demo">โหลดข้อมูลตัวอย่าง</button>`);
  if (A.noIncome) return head + empty('ยังไม่มีรายรับ', 'เพิ่มรายรับ (เช่น เงินเดือน) อย่างน้อย 1 รายการ เพื่อให้คำนวณสัดส่วนต่างๆ ได้', `<button class="btn primary" data-act="tx-add" data-type="income">บันทึกรายรับ</button>`);
  const monthly = ui.projMonthly ?? Math.max(0, Math.round(A.inc - A.exp)), rate = state.settings.projRate;
  return head + `<div class="stack"><div class="grid-wide"><section class="card" style="display:grid;gap:16px;align-content:start"><h2 style="margin:0">คะแนนสุขภาพการเงิน</h2>${gauge(A.score, A.grade)}<p class="muted" style="text-align:center">คำนวณจากค่าเฉลี่ย ${A.av.n} เดือน (${A.av.months.map(ymShort).join(', ')})<br>รายรับเฉลี่ย ${money(A.inc)} · รายจ่ายเฉลี่ย ${money(A.exp)}</p></section>
  <section class="card"><h2>สิ่งที่ควรทำก่อน</h2>${A.todo.length ? `<ol class="todo">${A.todo.map(m => `<li><b>${m.title}</b> (${m.value}) <div class="muted">${m.advice}</div></li>`).join('')}</ol>` : '<p>ทุกด้านอยู่ในเกณฑ์ดี รักษาวินัยไว้ และลองตั้งเป้าหมายใหม่ที่ใหญ่ขึ้น</p>'}</section></div>
  <section class="card"><h2>ผลรายด้าน</h2>${A.M.map(m => `<div class="metric"><h3>${m.title}</h3>${chip(m.score + '/100', m.status === 'good' ? 'ok' : m.status === 'fair' ? 'warn' : 'bad')}<div class="muted" style="grid-column:1/-1;font-size:14px">ตอนนี้ <b style="color:var(--ink)">${m.value}</b> · ${m.target}</div>${bar(m.score, 100, m.status === 'good' ? 'green' : m.status === 'fair' ? 'amber' : 'red')}<p>${m.advice}</p></div>`).join('')}</section>
  <section class="card"><h2>ถ้าออมต่อเนื่อง เงินจะเป็นเท่าไหร่</h2><div class="grid2" style="margin-bottom:8px"><div class="fld"><label for="pm">ออมต่อเดือน (บาท)</label><input id="pm" type="number" inputmode="decimal" min="0" step="any" value="${monthly}" data-change="proj-monthly"><small class="hint">ตั้งต้นจากรายรับเฉลี่ยหักรายจ่ายเฉลี่ย</small></div><div class="fld"><label for="pr">ผลตอบแทนต่อปี (%)</label><input id="pr" type="number" inputmode="decimal" min="0" step="any" value="${rate}" data-change="proj-rate"><small class="hint">เงินฝากทั่วไป 1–2% ตราสารหนี้/กองทุนผสม 3–5%</small></div></div>
  <table class="tbl"><thead><tr><th>ระยะเวลา</th><th>เงินต้นที่ออม</th><th>ผลตอบแทน</th><th>รวม</th></tr></thead><tbody>${[1, 5, 10, 20].map(y => { const tot = fv(A.total, monthly, rate, y), princ = A.total + monthly * y * 12; return `<tr><td>${y} ปี</td><td>${money(princ)}</td><td class="inc">${money(tot - princ)}</td><td><b>${money(tot)}</b></td></tr>`; }).join('')}</tbody></table><small class="hint" style="display:block;margin-top:10px">เป็นการประมาณการเบื้องต้น ไม่รวมเงินเฟ้อและภาษี ผลตอบแทนจริงขึ้นลงได้ ไม่ใช่คำแนะนำการลงทุน</small></section></div>`;
}

/* ============ SETTINGS ============ */
function pageSettings() {
  return pageHead('ตั้งค่าและข้อมูล', '') + `<div class="stack"><section class="card"><h2>ข้อมูลส่วนตัว</h2><div class="fld" style="max-width:360px"><label for="nm">ชื่อที่ให้แอพเรียก</label><input id="nm" type="text" value="${esc(state.settings.name)}" placeholder="เช่น ใบเตย" data-change="name"></div><p class="muted" id="sync2"></p></section>
  <section class="card"><h2>สำรองและย้ายข้อมูล</h2><p class="muted" style="margin-bottom:12px">ข้อมูลของคุณเก็บแยกเป็นส่วนตัว คนที่เปิดลิงก์เดียวกันจะไม่เห็นข้อมูลของคุณ แนะนำให้สำรองไฟล์ไว้เป็นระยะ</p><div class="btnrow">${dlCap ? `<button class="btn" data-act="export-json">${ic('download', 18)}สำรองข้อมูล (JSON)</button><button class="btn" data-act="export-csv">${ic('download', 18)}ส่งออกรายการ (CSV)</button>` : '<span class="muted">ปุ่มดาวน์โหลดใช้ไม่ได้ในมุมมองนี้</span>'}<label class="btn" style="cursor:pointer">${ic('upload', 18)}กู้คืนจากไฟล์<input type="file" accept="application/json,.json" data-change="import-json" hidden></label></div></section>
  <section class="card"><h2>ข้อมูลตัวอย่างและล้างข้อมูล</h2><div class="btnrow"><button class="btn" data-act="demo">โหลดข้อมูลตัวอย่าง</button><button class="btn danger" data-act="reset">ลบข้อมูลทั้งหมด</button></div><small class="hint" style="display:block;margin-top:10px">ทั้งสองปุ่มจะแทนที่ข้อมูลปัจจุบันทั้งหมด</small></section></div>`;
}

const pages = { home: pageHome, tx: pageTx, bills: pageBills, save: pageSave, debt: pageDebt, goals: pageGoals, wish: pageWish, budget: pageBudget, assess: pageAssess, settings: pageSettings };

/* ============ modal system ============ */
function closeModal() { const el = $('#modal'); el.hidden = true; el.innerHTML = ''; }
function openModal({ title, body, submit = 'บันทึก', onSubmit, onOpen, hideSubmit = false, danger = false }) {
  const el = $('#modal');
  el.innerHTML = `<div class="sheet" role="dialog" aria-modal="true" aria-labelledby="mt"><header><h2 id="mt">${title}</h2><button type="button" class="icon-btn" data-act="close-modal" aria-label="ปิด">${ic('x')}</button></header><form id="mform" novalidate>${body}<p class="err" id="merr" role="alert"></p><footer><button type="button" class="btn" data-act="close-modal">${hideSubmit ? 'ปิด' : 'ยกเลิก'}</button>${hideSubmit ? '' : `<button type="submit" class="btn ${danger ? 'danger' : 'primary'}">${submit}</button>`}</footer></form></div>`;
  el.hidden = false;
  const f = $('#mform');
  f.addEventListener('submit', e => { e.preventDefault(); const r = onSubmit ? onSubmit(Object.fromEntries(new FormData(f)), f) : undefined; if (r !== false) closeModal(); });
  if (onOpen) onOpen(f);
  const first = f.querySelector('input:not([type=radio]):not([type=hidden]):not([hidden]),select,textarea');
  (first || f.querySelector('button')).focus();
}
const err = (f, msg) => { $('#merr').textContent = msg; return false; };
const confirmBox = (title, text, ok, fn, danger = true) => openModal({ title, body: `<p style="margin-bottom:14px">${text}</p>`, submit: ok, danger, onSubmit() { fn(); } });
let toastT;
function toast(m) { const t = $('#toast'); t.textContent = m; t.hidden = false; clearTimeout(toastT); toastT = setTimeout(() => { t.hidden = true; }, 2400); }

const fld = (label, name, o = {}) => { const { type = 'text', value = '', ph = '', hint = '', show = '', attrs = '' } = o; return `<div class="fld" ${show ? `data-show="${show}"` : ''}><label for="f_${name}">${label}</label><input id="f_${name}" name="${name}" type="${type}" value="${esc(value)}" placeholder="${esc(ph)}" ${type === 'number' ? 'inputmode="decimal" step="any" min="0"' : ''} ${attrs}>${hint ? `<small class="hint">${hint}</small>` : ''}</div>`; };
const sel = (label, name, opts, value, o = {}) => `<div class="fld" ${o.show ? `data-show="${o.show}"` : ''}><label for="f_${name}">${label}</label><select id="f_${name}" name="${name}">${opts.map(([v, t]) => `<option value="${esc(v)}" ${String(v) === String(value) ? 'selected' : ''}>${esc(t)}</option>`).join('')}</select></div>`;
function bindShow(f, selName) {
  const s = f.elements[selName]; const apply = () => $$('[data-show]', f).forEach(el => { el.hidden = !el.dataset.show.split(' ').includes(s.value); });
  s.addEventListener('change', apply); apply();
}

/* ============ download / import ============ */
async function download(filename, data) {
  if (!dlCap) { toast('ดาวน์โหลดใช้ไม่ได้ในมุมมองนี้'); return; }
  try { await dlCap.save({ filename, data }); toast('บันทึกไฟล์แล้ว'); } catch (e) { if (e && e.code === 'declined') return; toast('ดาวน์โหลดไม่สำเร็จ'); }
}
const csvCell = v => '"' + String(v ?? '').replace(/"/g, '""') + '"';

/* ============ modals: transactions ============ */
function txModal(t, preset) {
  const edit = !!t, type = t ? t.type : (preset || 'expense');
  const defDate = ui.page === 'tx' && ui.ym !== curYm() ? ui.ym + '-01' : today();
  openModal({
    title: edit ? 'แก้ไขรายการ' : 'บันทึกรายการ',
    body: `<div class="fld"><div class="seg" role="radiogroup" aria-label="ประเภท"><label class="e"><input type="radio" name="type" value="expense" ${type === 'expense' ? 'checked' : ''}><span>รายจ่าย</span></label><label class="i"><input type="radio" name="type" value="income" ${type === 'income' ? 'checked' : ''}><span>รายรับ</span></label></div></div>`
      + fld('จำนวนเงิน (บาท)', 'amount', { type: 'number', value: t ? t.amount : '', ph: '0' })
      + `<div class="fld"><label for="f_cat">หมวดหมู่</label><select id="f_cat" name="cat"></select></div>`
      + fld('วันที่', 'date', { type: 'date', value: t ? t.date : defDate })
      + fld('บันทึกช่วยจำ', 'note', { value: t ? t.note : '', ph: 'เช่น ข้าวมันไก่ ค่าแท็กซี่' }),
    onOpen(f) {
      const fill = () => { const ty = f.elements.type.value; f.elements.cat.innerHTML = (ty === 'income' ? CATS_INC : CATS_EXP).map(c => `<option value="${c.id}">${c.name}</option>`).join(''); if (t && t.type === ty) f.elements.cat.value = t.cat; };
      f.querySelectorAll('[name=type]').forEach(r => r.addEventListener('change', fill)); fill();
    },
    onSubmit(v, f) {
      const amount = num(v.amount); if (!(amount > 0)) return err(f, 'ใส่จำนวนเงินที่มากกว่า 0'); if (!v.date) return err(f, 'เลือกวันที่');
      if (edit) Object.assign(t, { type: v.type, amount, cat: v.cat, date: v.date, note: v.note.trim() });
      else state.tx.push({ id: uid(), type: v.type, amount, cat: v.cat, date: v.date, note: v.note.trim() });
      if (ui.page === 'tx') ui.ym = v.date.slice(0, 7);
      commit(); toast('บันทึกแล้ว');
    },
  });
}
function delTx(id) {
  const t = state.tx.find(x => x.id === id); if (!t) return;
  state.tx = state.tx.filter(x => x.id !== id);
  state.bills.forEach(b => { for (const k in b.paid) if (b.paid[k] === id) delete b.paid[k]; });
  if (t.debtId) { const d = state.debts.find(x => x.id === t.debtId); const p = d && d.payments.find(x => x.txId === id); if (p) { d.balance += p.applied; d.payments = d.payments.filter(x => x !== p); } }
}

/* ============ modals: bills ============ */
function billModal(b) {
  const edit = !!b, now = new Date();
  openModal({
    title: edit ? 'แก้ไขรายการต้องจ่าย' : 'เพิ่มรายการต้องจ่าย',
    body: fld('ชื่อรายการ', 'name', { value: b ? b.name : '', ph: 'เช่น ค่าเช่า ค่าไฟ Netflix' }) + fld('จำนวนเงิน (บาท)', 'amount', { type: 'number', value: b ? b.amount : '' })
      + sel('ความถี่', 'freq', [['monthly', 'ทุกเดือน'], ['yearly', 'ทุกปี'], ['once', 'ครั้งเดียว']], b ? b.freq : 'monthly')
      + fld('ครบกำหนดวันที่ (1–31)', 'dueDay', { type: 'number', value: b ? b.dueDay : now.getDate(), show: 'monthly yearly', attrs: 'min="1" max="31" step="1"' })
      + sel('เดือนที่ครบกำหนด', 'dueMonth', TH_MF.map((m, i) => [i + 1, m]), b ? b.dueMonth : now.getMonth() + 1, { show: 'yearly' })
      + fld('วันที่ครบกำหนด', 'dueDate', { type: 'date', value: b ? b.dueDate : today(), show: 'once' })
      + sel('หมวดหมู่รายจ่าย', 'cat', CATS_EXP.map(c => [c.id, c.name]), b ? b.cat : 'utilities'),
    onOpen(f) { bindShow(f, 'freq'); },
    onSubmit(v, f) {
      const amount = num(v.amount); if (!v.name.trim()) return err(f, 'ใส่ชื่อรายการ'); if (!(amount > 0)) return err(f, 'ใส่จำนวนเงินที่มากกว่า 0');
      const o = { name: v.name.trim(), amount, freq: v.freq, cat: v.cat, dueDay: 1, dueMonth: null, dueDate: null };
      if (v.freq !== 'once') { const d = Math.round(num(v.dueDay)); if (d < 1 || d > 31) return err(f, 'วันที่ครบกำหนดต้องอยู่ระหว่าง 1–31'); o.dueDay = d; if (v.freq === 'yearly') o.dueMonth = +v.dueMonth; }
      else { if (!v.dueDate) return err(f, 'เลือกวันที่ครบกำหนด'); o.dueDate = v.dueDate; }
      if (edit) Object.assign(b, o); else state.bills.push({ id: uid(), active: true, paid: {}, startYm: o.freq === 'once' ? o.dueDate.slice(0, 7) : curYm(), ...o });
      commit(); toast('บันทึกแล้ว');
    },
  });
}

/* ============ modals: savings ============ */
function potModal(p, preset) {
  const edit = !!p, av = avgBasis(), emTarget = av.expense > 0 ? Math.round(av.expense * 6 / 1000) * 1000 : '';
  const d = p || (preset === 'emergency' ? { name: 'เงินสำรองฉุกเฉิน', kind: 'emergency', target: emTarget } : { name: '', kind: 'general', target: '' });
  openModal({
    title: edit ? 'แก้ไขกระปุก' : 'สร้างกระปุกเงินเก็บ',
    body: fld('ชื่อกระปุก', 'name', { value: d.name, ph: 'เช่น เงินสำรองฉุกเฉิน เที่ยวญี่ปุ่น' })
      + sel('ประเภท', 'kind', [['general', 'เงินเก็บทั่วไป'], ['emergency', 'เงินสำรองฉุกเฉิน']], d.kind)
      + fld('ยอดเป้าหมาย (ไม่ใส่ก็ได้)', 'target', { type: 'number', value: d.target || '', hint: preset === 'emergency' && emTarget ? 'แนะนำ 6 เท่าของรายจ่ายเฉลี่ยต่อเดือน' : '' })
      + (edit ? '' : fld('มีเงินอยู่แล้วเท่าไหร่ (ยอดยกมา)', 'opening', { type: 'number', value: '' })),
    onSubmit(v, f) {
      if (!v.name.trim()) return err(f, 'ใส่ชื่อกระปุก');
      if (edit) Object.assign(p, { name: v.name.trim(), kind: v.kind, target: num(v.target) });
      else { const np = { id: uid(), name: v.name.trim(), kind: v.kind, target: num(v.target), log: [] }; if (num(v.opening) > 0) potAdd(np, num(v.opening), today(), 'ยอดยกมา', { opening: true }); state.pots.push(np); }
      commit(); toast('บันทึกแล้ว');
    },
  });
}
function potMoveModal(p, dir) {
  const bal = potBal(p);
  openModal({
    title: (dir > 0 ? 'ฝากเข้า ' : 'ถอนจาก ') + esc(p.name), submit: dir > 0 ? 'ฝากเงิน' : 'ถอนเงิน',
    body: `<p class="muted" style="margin-bottom:12px">ยอดคงเหลือ ${moneyx(bal)}</p>` + fld('จำนวนเงิน (บาท)', 'amount', { type: 'number' }) + fld('วันที่', 'date', { type: 'date', value: today() }) + fld('บันทึกช่วยจำ', 'note', { ph: dir > 0 ? 'เช่น โบนัสประจำปี' : 'เช่น ใช้ซ่อมรถ' }),
    onSubmit(v, f) {
      const a = num(v.amount); if (!(a > 0)) return err(f, 'ใส่จำนวนเงินที่มากกว่า 0'); if (!v.date) return err(f, 'เลือกวันที่');
      if (dir < 0 && a > bal + 0.005) return err(f, 'ถอนได้ไม่เกินยอดคงเหลือ ' + moneyx(bal));
      potAdd(p, dir * a, v.date, v.note.trim()); commit(); toast(dir > 0 ? 'ฝากแล้ว' : 'ถอนแล้ว');
    },
  });
}
function potHist(id) {
  const p = state.pots.find(x => x.id === id); if (!p) return;
  const logs = [...p.log].sort((a, b) => b.date.localeCompare(a.date));
  openModal({ title: 'ประวัติ ' + esc(p.name), hideSubmit: true, body: logs.length ? `<ul class="list">${logs.map(l => `<li class="row"><div class="row-main"><b>${esc(l.note || (l.amount > 0 ? 'ฝากเงิน' : 'ถอนเงิน'))}</b><small>${fmtDate(l.date)}</small></div><span class="amt ${l.amount > 0 ? 'inc' : 'exp'}">${l.amount > 0 ? '+' : '−'}${moneyx(Math.abs(l.amount))}</span>${iconBtn('log-del', 'trash', 'ลบรายการนี้', `data-id="${l.id}" data-pid="${p.id}"`)}</li>`).join('')}</ul>` : '<p class="muted">ยังไม่มีประวัติ</p>' });
}
function planModal(kind = 'week52') {
  const income = Math.round(expectedIncome()) || '';
  openModal({
    title: 'สร้างแบบออมเงิน', submit: 'สร้างแผน',
    body: sel('แบบออม', 'kind', Object.entries(PLAN_KIND), kind) + fld('ชื่อแผน', 'name', { ph: 'เว้นว่างไว้จะใช้ชื่อแบบออม' })
      + fld('ออมเพิ่มสัปดาห์ละ (บาท)', 'stepAmt', { type: 'number', value: 10, show: 'week52', hint: 'สัปดาห์ที่ n ออม n เท่าของค่านี้ เช่น 10 บาท ครบ 52 สัปดาห์ได้ 13,780 บาท' })
      + fld('ออมครั้งละ (บาท)', 'amt', { type: 'number', value: 1000, show: 'monthly weekly daily' })
      + fld('จำนวนงวด', 'count', { type: 'number', value: 12, show: 'monthly weekly daily percent', attrs: 'min="1" max="365" step="1"', hint: 'นับเป็นเดือน สัปดาห์ หรือวัน ตามแบบที่เลือก' })
      + fld('ออมกี่ % ของรายได้', 'pct', { type: 'number', value: 15, show: 'percent' }) + fld('รายได้ต่อเดือนที่ใช้คำนวณ (บาท)', 'income', { type: 'number', value: income, show: 'percent' })
      + fld('วันที่เริ่ม', 'start', { type: 'date', value: today() })
      + sel('ฝากเข้ากระปุก', 'pot', [['', 'ไม่ผูกกระปุก (ติ๊กเฉยๆ)'], ...state.pots.map(p => [p.id, p.name])], state.pots[0] ? state.pots[0].id : ''),
    onOpen(f) { bindShow(f, 'kind'); },
    onSubmit(v, f) {
      const o = { kind: v.kind, name: v.name.trim() || PLAN_KIND[v.kind], potId: v.pot, start: v.start || today() };
      if (v.kind === 'week52') { o.amount = num(v.stepAmt); if (!(o.amount > 0)) return err(f, 'ใส่ยอดที่ออมเพิ่มต่อสัปดาห์'); }
      else {
        o.count = Math.round(num(v.count)); if (o.count < 1 || o.count > 365) return err(f, 'จำนวนงวดต้องอยู่ระหว่าง 1–365');
        if (v.kind === 'percent') { o.pct = num(v.pct); o.income = num(v.income); if (!(o.pct > 0 && o.pct <= 100)) return err(f, 'เปอร์เซ็นต์ต้องอยู่ระหว่าง 1–100'); if (!(o.income > 0)) return err(f, 'ใส่รายได้ต่อเดือนที่ใช้คำนวณ'); }
        else { o.amount = num(v.amt); if (!(o.amount > 0)) return err(f, 'ใส่จำนวนเงินที่ออมแต่ละครั้ง'); }
      }
      state.plans.push(makePlan(o)); ui.saveTab = 'plans'; commit(); toast('สร้างแผนแล้ว');
    },
  });
}

/* ============ modals: debts ============ */
function debtModal(d) {
  const edit = !!d;
  openModal({
    title: edit ? 'แก้ไขหนี้' : 'เพิ่มหนี้',
    body: fld('ชื่อหนี้', 'name', { value: d ? d.name : '', ph: 'เช่น บัตรเครดิต KTC ผ่อนรถ' }) + sel('ประเภท', 'type', DEBT_TYPES.map(t => [t, t]), d ? d.type : DEBT_TYPES[0])
      + fld('ยอดหนี้เดิมทั้งหมด (บาท)', 'principal', { type: 'number', value: d ? d.principal : '' }) + fld('ยอดคงเหลือตอนนี้ (บาท)', 'balance', { type: 'number', value: d ? d.balance : '', hint: edit ? '' : 'ถ้าเว้นว่างจะใช้เท่ากับยอดหนี้เดิม' })
      + fld('ดอกเบี้ยต่อปี (%)', 'rate', { type: 'number', value: d ? d.rate : '', ph: '0 ถ้าไม่มีดอกเบี้ย' }) + fld('ผ่อนขั้นต่ำต่อเดือน (บาท)', 'minPay', { type: 'number', value: d ? d.minPay : '' })
      + fld('ครบกำหนดวันที่ (ไม่ใส่ก็ได้)', 'dueDay', { type: 'number', value: d ? d.dueDay || '' : '', attrs: 'min="1" max="31" step="1"' }),
    onSubmit(v, f) {
      if (!v.name.trim()) return err(f, 'ใส่ชื่อหนี้'); let principal = num(v.principal), bal = v.balance === '' ? principal : num(v.balance);
      if (!(principal > 0) && !(bal > 0)) return err(f, 'ใส่ยอดหนี้'); if (!(principal > 0)) principal = bal; if (bal > principal) principal = bal;
      const o = { name: v.name.trim(), type: v.type, principal, balance: bal, rate: num(v.rate), minPay: num(v.minPay), dueDay: Math.round(num(v.dueDay)) || 0 };
      if (edit) Object.assign(d, o); else state.debts.push({ id: uid(), payments: [], ...o });
      commit(); toast('บันทึกแล้ว');
    },
  });
}
function debtPayModal(d) {
  openModal({
    title: 'บันทึกการชำระ ' + esc(d.name), submit: 'บันทึกการชำระ',
    body: `<p class="muted" style="margin-bottom:12px">ยอดคงเหลือ ${moneyx(d.balance)} · ระบบจะบันทึกเป็นรายจ่ายหมวด “ผ่อนชำระหนี้” ให้ด้วย</p>` + fld('จำนวนที่จ่าย (บาท)', 'amount', { type: 'number', value: Math.min(d.minPay || d.balance, d.balance) || '' }) + fld('วันที่จ่าย', 'date', { type: 'date', value: today() }) + fld('บันทึกช่วยจำ', 'note', {}),
    onSubmit(v, f) { const a = num(v.amount); if (!(a > 0)) return err(f, 'ใส่จำนวนเงินที่มากกว่า 0'); if (!v.date) return err(f, 'เลือกวันที่'); payDebt(d, a, v.date, v.note.trim()); commit(); toast(d.balance <= 0.005 ? 'ปิดหนี้ก้อนนี้ได้แล้ว' : 'บันทึกการชำระแล้ว'); },
  });
}
function debtHist(id) {
  const d = state.debts.find(x => x.id === id); if (!d) return; const ps = [...d.payments].sort((a, b) => b.date.localeCompare(a.date));
  openModal({ title: 'ประวัติการชำระ ' + esc(d.name), hideSubmit: true, body: ps.length ? `<ul class="list">${ps.map(p => `<li class="row"><div class="row-main"><b>จ่าย ${moneyx(p.amount)}</b><small>${fmtDate(p.date)}</small></div><span class="amt">ลดหนี้ ${moneyx(p.applied)}</span>${iconBtn('pay-del', 'trash', 'ยกเลิกการชำระนี้', `data-id="${p.id}" data-pid="${d.id}"`)}</li>`).join('')}</ul>` : '<p class="muted">ยังไม่มีประวัติการชำระ</p>' });
}

/* ============ modals: goals / wishes ============ */
function goalModal(g) {
  const edit = !!g;
  openModal({
    title: edit ? 'แก้ไขเป้าหมาย' : 'ตั้งเป้าหมาย',
    body: fld('ชื่อเป้าหมาย', 'name', { value: g ? g.name : '', ph: 'เช่น เที่ยวญี่ปุ่น ดาวน์รถ' }) + fld('ยอดที่ต้องการ (บาท)', 'target', { type: 'number', value: g ? g.target : '' })
      + fld('อยากได้ภายในวันที่ (ไม่ใส่ก็ได้)', 'deadline', { type: 'date', value: g ? g.deadline : '' })
      + sel('เก็บเงินที่ไหน', 'potId', [['', 'เก็บแยกในเป้าหมายนี้'], ...state.pots.map(p => ['' + p.id, 'ดึงยอดจากกระปุก: ' + p.name])], g ? g.potId || '' : '')
      + (edit ? '' : fld('มีเงินสำหรับเป้าหมายนี้แล้วเท่าไหร่', 'initial', { type: 'number', hint: 'ใช้เมื่อเลือกเก็บแยกในเป้าหมายเท่านั้น' })) + fld('โน้ต', 'note', { value: g ? g.note : '' }),
    onSubmit(v, f) {
      const target = num(v.target); if (!v.name.trim()) return err(f, 'ใส่ชื่อเป้าหมาย'); if (!(target > 0)) return err(f, 'ใส่ยอดที่ต้องการมากกว่า 0');
      const o = { name: v.name.trim(), target, deadline: v.deadline || '', potId: v.potId || null, note: v.note.trim() };
      if (edit) Object.assign(g, o); else { const ng = { id: uid(), log: [], ...o }; if (!ng.potId && num(v.initial) > 0) ng.log.push({ id: uid(), date: today(), amount: num(v.initial), note: 'ยอดเริ่มต้น' }); state.goals.push(ng); }
      commit(); toast('บันทึกแล้ว');
    },
  });
}
function goalDepModal(g) {
  const pot = goalPot(g);
  openModal({
    title: 'เพิ่มเงินให้ ' + esc(g.name), submit: 'เพิ่มเงิน',
    body: `<p class="muted" style="margin-bottom:12px">${pot ? 'เป้าหมายนี้ดึงยอดจากกระปุก “' + esc(pot.name) + '” เงินที่เพิ่มจะฝากเข้ากระปุกนั้น' : 'ยังขาดอีก ' + moneyx(Math.max(0, g.target - goalSaved(g)))}</p>` + fld('จำนวนเงิน (บาท)', 'amount', { type: 'number' }) + fld('วันที่', 'date', { type: 'date', value: today() }) + fld('บันทึกช่วยจำ', 'note', {}),
    onSubmit(v, f) { const a = num(v.amount); if (!(a > 0)) return err(f, 'ใส่จำนวนเงินที่มากกว่า 0'); if (!v.date) return err(f, 'เลือกวันที่'); if (pot) potAdd(pot, a, v.date, 'เป้าหมาย: ' + g.name + (v.note ? ' · ' + v.note.trim() : '')); else g.log.push({ id: uid(), date: v.date, amount: a, note: v.note.trim() }); commit(); toast('เพิ่มเงินแล้ว'); },
  });
}
function goalHist(id) {
  const g = state.goals.find(x => x.id === id); if (!g) return; const logs = [...g.log].sort((a, b) => b.date.localeCompare(a.date));
  openModal({ title: 'ประวัติ ' + esc(g.name), hideSubmit: true, body: logs.length ? `<ul class="list">${logs.map(l => `<li class="row"><div class="row-main"><b>${esc(l.note || 'เพิ่มเงิน')}</b><small>${fmtDate(l.date)}</small></div><span class="amt inc">+${moneyx(l.amount)}</span>${iconBtn('glog-del', 'trash', 'ลบ', `data-id="${l.id}" data-pid="${g.id}"`)}</li>`).join('')}</ul>` : '<p class="muted">ยังไม่มีประวัติ</p>' });
}
function wishModal(w) {
  const edit = !!w;
  openModal({
    title: edit ? 'แก้ไขของที่อยากได้' : 'เพิ่มของที่อยากได้',
    body: fld('ชื่อสิ่งของ', 'name', { value: w ? w.name : '', ph: 'เช่น หูฟังไร้สาย' }) + fld('ราคา (บาท)', 'price', { type: 'number', value: w ? w.price : '' })
      + sel('ความอยากได้', 'priority', [[3, 'อยากมาก'], [2, 'อยากพอควร'], [1, 'อยากได้เฉยๆ']], w ? w.priority : 2) + fld('โน้ต/ลิงก์ร้าน', 'note', { value: w ? w.note : '' }),
    onSubmit(v, f) {
      const price = num(v.price); if (!v.name.trim()) return err(f, 'ใส่ชื่อสิ่งของ'); if (!(price > 0)) return err(f, 'ใส่ราคามากกว่า 0');
      const o = { name: v.name.trim(), price, priority: +v.priority, note: v.note.trim() };
      if (edit) Object.assign(w, o); else state.wishes.push({ id: uid(), added: today(), status: 'want', ...o });
      commit(); toast('บันทึกแล้ว');
    },
  });
}
function wishBuyModal(w) {
  const days = dayDiff(w.added, today());
  openModal({
    title: 'ซื้อ ' + esc(w.name) + ' แล้ว', submit: 'บันทึกว่าซื้อแล้ว',
    body: `<p class="muted" style="margin-bottom:12px">${days < 30 ? `จดไว้มา ${days} วัน ยังไม่ครบ 30 วัน ` : ''}ระบบจะบันทึกเป็นรายจ่ายหมวดช้อปปิ้งให้</p>` + fld('ราคาที่จ่ายจริง (บาท)', 'amount', { type: 'number', value: w.price }) + fld('วันที่ซื้อ', 'date', { type: 'date', value: today() }),
    onSubmit(v, f) { const a = num(v.amount); if (!(a > 0)) return err(f, 'ใส่ราคาที่จ่ายจริง'); if (!v.date) return err(f, 'เลือกวันที่'); state.tx.push({ id: uid(), type: 'expense', amount: a, cat: 'shopping', date: v.date, note: w.name }); w.status = 'bought'; w.boughtDate = v.date; w.price = a; commit(); toast('บันทึกแล้ว'); },
  });
}

/* ============ demo data ============ */
const addDays = (s, n) => { const d = parseD(s); d.setDate(d.getDate() + n); return toStr(d); };
function buildDemo() {
  let seed = 7; const rnd = () => (seed = (seed * 16807) % 2147483647) / 2147483647;
  const pick = a => a[Math.floor(rnd() * a.length)], R = (a, b) => Math.round(a + rnd() * (b - a));
  state = blank(); const S = state; S.settings.baseIncome = 32000; S.settings.savePct = 15;
  const cur = curYm(), td = today(), dayNow = +td.slice(8);
  const T = (date, type, cat, amount, note) => S.tx.push({ id: uid(), type, cat, amount, date, note });
  for (let k = 3; k >= 0; k--) {
    const ym = shiftYm(cur, -k), [y, m] = ym.split('-').map(Number), last = k === 0 ? dayNow : daysIn(y, m);
    if (last >= 25) T(ym + '-25', 'income', 'salary', 32000, 'เงินเดือน');
    if (last >= 18 && rnd() > .35) T(ym + '-18', 'income', 'side', R(2500, 6000), 'งานเสริม');
    for (let d = 1; d <= last; d++) {
      const date = ym + '-' + p2(d);
      T(date, 'expense', 'food', R(70, 190), pick(['ข้าวกลางวัน', 'ข้าวเย็น', 'ตลาดสด', 'ซื้อของเข้าบ้าน']));
      if (rnd() < .55) T(date, 'expense', 'transport', R(20, 160), pick(['BTS', 'วินมอเตอร์ไซค์', 'น้ำมัน', 'แท็กซี่']));
      if (rnd() < .2) T(date, 'expense', 'dining', R(150, 520), pick(['คาเฟ่', 'ปิ้งย่าง', 'ชาบู', 'กาแฟ']));
      if (rnd() < .07) T(date, 'expense', 'shopping', R(250, 1900), pick(['เสื้อผ้า', 'ของใช้', 'ช้อปออนไลน์']));
      if (rnd() < .06) T(date, 'expense', 'fun', R(200, 900), pick(['ดูหนัง', 'เกม', 'เที่ยวใกล้ๆ']));
      if (rnd() < .04) T(date, 'expense', 'health', R(150, 700), pick(['ยา', 'ทำฟัน']));
    }
  }
  const sy = shiftYm(cur, -3), mk = (name, amount, cat, freq, dueDay, extra = {}) => { const b = { id: uid(), name, amount, cat, freq, dueDay, active: true, paid: {}, startYm: sy, ...extra }; S.bills.push(b); return b; };
  const bl = [mk('ค่าเช่าห้อง', 8500, 'housing', 'monthly', 1), mk('ค่าไฟ', R(900, 1300), 'utilities', 'monthly', 12), mk('อินเทอร์เน็ต', 599, 'utilities', 'monthly', 15), mk('Netflix', 419, 'fun', 'monthly', 8), mk('ค่าโทรศัพท์', 399, 'utilities', 'monthly', 20), mk('ประกันรถ', 14500, 'insurance', 'yearly', 20, { dueMonth: +shiftYm(cur, 2).slice(5) })];
  for (let k = 3; k >= 0; k--) { const ym = shiftYm(cur, -k); for (const b of bl) { const due = billDue(b, ym); if (!due || due > td) continue; if (k === 0 && b.name === 'Netflix') continue; payBill(b, ym); const tx = S.tx.find(t => t.id === b.paid[ym]); if (tx) tx.date = due; } }
  const card = { id: uid(), name: 'บัตรเครดิต KTC', type: 'บัตรเครดิต', principal: 32000, balance: 32000, rate: 16, minPay: 1800, dueDay: 5, payments: [] };
  const phone = { id: uid(), name: 'ผ่อนโทรศัพท์ 0%', type: 'ผ่อนสินค้า', principal: 24000, balance: 24000, rate: 0, minPay: 2000, dueDay: 10, payments: [] };
  S.debts.push(card, phone);
  for (let k = 3; k >= 0; k--) { const ym = shiftYm(cur, -k); for (const d of [card, phone]) { const date = ym + '-' + p2(d.dueDay); if (date <= td) payDebt(d, d.minPay, date, ''); } }
  const em = { id: uid(), name: 'เงินสำรองฉุกเฉิน', kind: 'emergency', target: 150000, log: [] }, trip = { id: uid(), name: 'เก็บเที่ยวญี่ปุ่น', kind: 'general', target: 60000, log: [] };
  potAdd(em, 42000, shiftYm(cur, -3) + '-01', 'ยอดยกมา', { opening: true }); potAdd(trip, 8000, shiftYm(cur, -3) + '-01', 'ยอดยกมา', { opening: true });
  for (let k = 2; k >= 0; k--) { const date = shiftYm(cur, -k) + '-26'; if (date <= td) potAdd(em, 3000, date, 'ออมประจำเดือน'); }
  S.pots.push(em, trip);
  const pl = makePlan({ kind: 'week52', name: 'ออม 52 สัปดาห์', potId: trip.id, start: addDays(td, -42), amount: 10 }); S.plans.push(pl); for (let i = 0; i < 5; i++) toggleStep(pl, i);
  S.goals.push({ id: uid(), name: 'เที่ยวญี่ปุ่น', target: 60000, deadline: shiftYm(cur, 9) + '-15', potId: trip.id, note: 'ไปช่วงใบไม้เปลี่ยนสี', log: [] });
  S.goals.push({ id: uid(), name: 'โน้ตบุ๊กเครื่องใหม่', target: 35000, deadline: shiftYm(cur, 5) + '-01', potId: null, note: '', log: [{ id: uid(), date: td, amount: 9000, note: 'ยอดเริ่มต้น' }] });
  S.wishes.push({ id: uid(), name: 'หูฟังตัดเสียงรบกวน', price: 4590, priority: 2, note: '', added: addDays(td, -12), status: 'want' }, { id: uid(), name: 'iPad', price: 15900, priority: 3, note: 'ไว้จดโน้ตเรียน', added: addDays(td, -40), status: 'want' }, { id: uid(), name: 'รองเท้าวิ่ง', price: 3200, priority: 1, note: '', added: addDays(td, -3), status: 'want' });
}

/* ============ actions ============ */
const A = {
  'close-modal': closeModal,
  ym(d) { ui.ym = shiftYm(ui.ym, +d.d); render(); },
  'ym-now'() { ui.ym = curYm(); render(); },
  menu() { openModal({ title: 'เมนู', hideSubmit: true, body: `<div style="display:grid;gap:4px;margin-bottom:6px">${[...NAV, { id: 'settings', t: 'ตั้งค่าและข้อมูล', i: 'gear' }].map(n => `<button type="button" class="navbtn" data-go="${n.id}" ${ui.page === n.id ? 'aria-current="page"' : ''}>${ic(n.i)}<span>${n.t}</span></button>`).join('')}</div>` }); },
  tab(d) { ui.saveTab = d.t; render(); },
  demo() { const run = () => { buildDemo(); ui.ym = curYm(); commit(); toast('โหลดข้อมูลตัวอย่างแล้ว'); }; if (state.tx.length || state.pots.length || state.debts.length || state.bills.length) confirmBox('แทนที่ด้วยข้อมูลตัวอย่าง?', 'ข้อมูลที่มีอยู่ตอนนี้ทั้งหมดจะถูกแทนที่ ย้อนกลับไม่ได้', 'แทนที่ข้อมูล', run); else run(); },
  reset() { confirmBox('ลบข้อมูลทั้งหมด?', 'รายการ บิล เงินเก็บ หนี้ และเป้าหมายทั้งหมดจะถูกลบ ย้อนกลับไม่ได้ แนะนำให้สำรองข้อมูลก่อน', 'ลบทั้งหมด', () => { state = blank(); ui.ym = curYm(); commit(); toast('ลบข้อมูลแล้ว'); }); },
  'export-json'() { download('finance-backup-' + today() + '.json', JSON.stringify(state, null, 1)); },
  'export-csv'() { const rows = [['วันที่', 'ประเภท', 'หมวดหมู่', 'จำนวน', 'บันทึก'], ...[...state.tx].sort((a, b) => a.date.localeCompare(b.date)).map(t => [t.date, t.type === 'income' ? 'รายรับ' : 'รายจ่าย', catOf(t.type, t.cat).name, t.amount, t.note || ''])]; download('finance-transactions-' + today() + '.csv', '\ufeff' + rows.map(r => r.map(csvCell).join(',')).join('\r\n')); },
  /* transactions */
  'tx-add'(d) { txModal(null, d.type); },
  'tx-edit'(d) { const t = state.tx.find(x => x.id === d.id); if (t) txModal(t); },
  'tx-del'(d) { confirmBox('ลบรายการนี้?', 'รายการจะถูกลบถาวร', 'ลบ', () => { delTx(d.id); commit(); toast('ลบแล้ว'); }); },
  /* bills */
  'bill-add'() { billModal(null); },
  'bill-edit'(d) { billModal(state.bills.find(b => b.id === d.id)); },
  'bill-del'(d) { confirmBox('ลบรายการต้องจ่ายนี้?', 'รายจ่ายที่เคยบันทึกไว้จะยังอยู่ในประวัติ', 'ลบ', () => { state.bills = state.bills.filter(b => b.id !== d.id); commit(); }); },
  'bill-pause'(d) { const b = state.bills.find(x => x.id === d.id); b.active = b.active === false; commit(); },
  'bill-toggle'(d) { const b = state.bills.find(x => x.id === d.id); if (b.paid[ui.ym]) unpayBill(b, ui.ym); else payBill(b, ui.ym); commit(); },
  /* pots + plans */
  'pot-add'() { potModal(null); }, 'pot-preset'() { potModal(null, 'emergency'); },
  'pot-edit'(d) { potModal(state.pots.find(p => p.id === d.id)); },
  'pot-dep'(d) { potMoveModal(state.pots.find(p => p.id === d.id), 1); }, 'pot-wd'(d) { potMoveModal(state.pots.find(p => p.id === d.id), -1); },
  'pot-hist'(d) { potHist(d.id); },
  'pot-del'(d) { const p = state.pots.find(x => x.id === d.id); confirmBox('ลบกระปุก “' + esc(p.name) + '”?', `ยอดคงเหลือ ${moneyx(potBal(p))} จะหายไปจากสรุปเงินเก็บ ถ้าเป็นการย้ายเงินให้ถอนออกก่อน`, 'ลบกระปุก', () => { state.pots = state.pots.filter(x => x.id !== p.id); state.plans.forEach(pl => { if (pl.potId === p.id) pl.potId = null; }); state.goals.forEach(g => { if (g.potId === p.id) g.potId = null; }); commit(); }); },
  'log-del'(d) { const p = state.pots.find(x => x.id === d.pid), l = p && p.log.find(x => x.id === d.id); if (!l) return; p.log = p.log.filter(x => x !== l); state.plans.forEach(pl => pl.steps.forEach(s => { if (s.logId === l.id) { s.done = null; s.logId = null; } })); commit(); potHist(p.id); },
  'plan-add'(d) { planModal(d.kind || 'week52'); },
  'plan-del'(d) { confirmBox('ลบแผนออมเงินนี้?', 'เงินที่ฝากเข้ากระปุกไปแล้วจะยังอยู่ในกระปุก', 'ลบแผน', () => { state.plans = state.plans.filter(p => p.id !== d.id); commit(); }); },
  step(d) { const pl = state.plans.find(p => p.id === d.id); toggleStep(pl, +d.i); commit(); },
  /* debts */
  'debt-add'() { debtModal(null); }, 'debt-edit'(d) { debtModal(state.debts.find(x => x.id === d.id)); },
  'debt-pay'(d) { debtPayModal(state.debts.find(x => x.id === d.id)); }, 'debt-hist'(d) { debtHist(d.id); },
  'debt-del'(d) { const x = state.debts.find(y => y.id === d.id); confirmBox('ลบหนี้ “' + esc(x.name) + '”?', 'รายจ่ายที่เคยบันทึกจากการผ่อนจะยังอยู่ในประวัติ', 'ลบ', () => { state.debts = state.debts.filter(y => y.id !== x.id); commit(); }); },
  'pay-del'(d) { const x = state.debts.find(y => y.id === d.pid); undoDebtPayment(x, d.id); commit(); debtHist(x.id); },
  /* goals */
  'goal-add'() { goalModal(null); }, 'goal-edit'(d) { goalModal(state.goals.find(g => g.id === d.id)); },
  'goal-dep'(d) { goalDepModal(state.goals.find(g => g.id === d.id)); }, 'goal-hist'(d) { goalHist(d.id); },
  'goal-del'(d) { const g = state.goals.find(x => x.id === d.id); confirmBox('ลบเป้าหมาย “' + esc(g.name) + '”?', 'กระปุกที่ผูกไว้ (ถ้ามี) ยังอยู่ตามเดิม', 'ลบ', () => { state.goals = state.goals.filter(x => x.id !== g.id); commit(); }); },
  'glog-del'(d) { const g = state.goals.find(x => x.id === d.pid); g.log = g.log.filter(l => l.id !== d.id); commit(); goalHist(g.id); },
  /* wishes */
  'wish-add'() { wishModal(null); }, 'wish-edit'(d) { wishModal(state.wishes.find(w => w.id === d.id)); }, 'wish-buy'(d) { wishBuyModal(state.wishes.find(w => w.id === d.id)); },
  'wish-del'(d) { confirmBox('ลบรายการนี้?', 'จะลบออกจากรายการของที่อยากได้', 'ลบ', () => { state.wishes = state.wishes.filter(w => w.id !== d.id); commit(); }); },
  'wish-goal'(d) { const w = state.wishes.find(x => x.id === d.id); state.goals.push({ id: uid(), name: w.name, target: w.price, deadline: '', potId: null, note: w.note || '', log: [] }); state.wishes = state.wishes.filter(x => x.id !== w.id); ui.page = 'goals'; commit(); toast('ย้ายไปเป็นเป้าหมายแล้ว'); },
  'wish-show'() { ui.showBought = !ui.showBought; render(); },
  /* budget */
  'budget-auto'() { const av = avgBasis(); if (!av.n) { toast('ยังไม่มีข้อมูลย้อนหลังให้คำนวณ'); return; } const b = {}; CATS_EXP.forEach(c => { const a = sum(av.sts, s => s.byCat[c.id] || 0) / av.n; if (a > 0) b[c.id] = Math.ceil(a / 100) * 100; }); state.settings.budgets = b; commit(); toast('ตั้งงบจากค่าเฉลี่ย ' + av.n + ' เดือนแล้ว'); },
  'budget-clear'() { state.settings.budgets = {}; commit(); },
};
const C = {
  'tx-filter'(t) { ui.txType = t.value; render(); },
  'tx-cat'(t) { ui.txCat = t.value; render(); },
  'tx-q'(t) { ui.q = t.value; $('#txlist').innerHTML = txListHTML(); },
  'base-income'(t) { state.settings.baseIncome = Math.max(0, num(t.value)); commit(); },
  'save-pct'(t) { state.settings.savePct = clamp(num(t.value), 0, 100); commit(); },
  'ratio-preset'(t) { state.settings.ratio = t.value.split(',').map(Number); commit(); },
  'cat-limit'(t) {
    const id = t.dataset.cat, v = num(t.value); if (v > 0) state.settings.budgets[id] = v; else delete state.settings.budgets[id]; commit(false);
    const c = CATS_EXP.find(x => x.id === id), st = monthStats(ui.ym), row = $('#cb_' + id); if (row) row.outerHTML = catBudgetRow(c, st.byCat[id] || 0, state.settings.budgets[id] || 0);
    const sm = $('#cbsum'); if (sm) sm.innerHTML = cbSummary(st);
  },
  extra(t) { ui.extra = Math.max(0, num(t.value)); render(); },
  'proj-monthly'(t) { ui.projMonthly = Math.max(0, num(t.value)); render(); },
  'proj-rate'(t) { state.settings.projRate = clamp(num(t.value), 0, 30); commit(); },
  name(t) { state.settings.name = t.value.trim(); commit(false); toast('บันทึกชื่อแล้ว'); },
  'import-json'(t) {
    const file = t.files && t.files[0]; if (!file) return;
    const rd = new FileReader();
    rd.onload = () => {
      try { const o = JSON.parse(rd.result); if (!o || !Array.isArray(o.tx)) throw new Error('bad'); confirmBox('กู้คืนข้อมูลจากไฟล์?', `พบรายการ ${o.tx.length} รายการ ข้อมูลปัจจุบันจะถูกแทนที่`, 'กู้คืนข้อมูล', () => { state = normalize(o); commit(); toast('กู้คืนข้อมูลแล้ว'); }, false); }
      catch (e) { toast('ไฟล์ไม่ถูกต้อง ใช้ไฟล์สำรองที่ได้จากแอพนี้'); }
    };
    rd.readAsText(file); t.value = '';
  },
};

/* ============ render + events ============ */
let booted = false;
function render() {
  if (!booted) return;
  $('#view').innerHTML = (pages[ui.page] || pageHome)();
  $('#sidenav').innerHTML = NAV.map(n => `<button class="navbtn" data-go="${n.id}" ${ui.page === n.id ? 'aria-current="page"' : ''}>${ic(n.i)}<span>${n.t}</span></button>`).join('');
  $('#sidegear').setAttribute('aria-current', ui.page === 'settings' ? 'page' : 'false');
  const BN = [['home', 'ภาพรวม', 'home'], ['tx', 'รายการ', 'swap'], ['bills', 'ต้องจ่าย', 'calendar'], ['save', 'เงินเก็บ', 'coins']];
  $('#bottomnav').innerHTML = BN.map(([id, t, i]) => `<button data-go="${id}" ${ui.page === id ? 'aria-current="page"' : ''}>${ic(i, 22)}${t}</button>`).join('') + `<button data-act="menu" ${BN.some(b => b[0] === ui.page) ? '' : 'aria-current="page"'}>${ic('list', 22)}เมนู</button>`;
  document.title = (PAGE_TITLE[ui.page] || 'สมุดเงิน') + ' · สมุดเงิน';
  setSync(lastSync);
}
function go(p) { ui.page = p; closeModal(); render(); window.scrollTo(0, 0); }
document.addEventListener('click', e => {
  const g = e.target.closest('[data-go]'); if (g) { go(g.dataset.go); return; }
  const t = e.target.closest('[data-act]'); if (!t) return;
  const f = A[t.dataset.act]; if (f) { e.preventDefault(); f(t.dataset, t); }
});
document.addEventListener('change', e => { const t = e.target.closest('[data-change]'); if (t && C[t.dataset.change]) C[t.dataset.change](t, e); });
document.addEventListener('input', e => { const t = e.target.closest('[data-input]'); if (t && C[t.dataset.input]) C[t.dataset.input](t, e); });
$('#modal').addEventListener('mousedown', e => { if (e.target.id === 'modal') closeModal(); });
document.addEventListener('keydown', e => { if (e.key === 'Escape' && !$('#modal').hidden) closeModal(); });

(async function startApp() { await boot(); })();


</script>
</body>
</html>
