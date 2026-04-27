<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Université Numérique — Portail Enseignant</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet"/>
<script>
tailwind.config = {
  theme: {
    extend: {
      fontFamily: { display: ['Syne','sans-serif'], body: ['DM Sans','sans-serif'] },
      colors: {
        navy: '#0F1B2D', navyL: '#162236', navyLL: '#1E2E45',
        primary: '#2D6BE4', primaryH: '#1A56C7',
        accent: '#F59E0B',
        sage: '#10B981', red: '#EF4444', orange: '#F97316', purple: '#8B5CF6',
        paper: '#F7F8FC', border: '#E4E8F0',
        ink: '#0F1B2D', muted: '#6B7B93',
      }
    }
  }
}
</script>
<style>
*, *::before, *::after { box-sizing: border-box; }
body { font-family: 'DM Sans', sans-serif; background: #F7F8FC; color: #0F1B2D; margin: 0; }
h1, h2, h3, h4, .font-display { font-family: 'Syne', sans-serif; }
.sidebar-link { transition: all 0.18s; border-radius: 10px; }
.sidebar-link:hover { background: rgba(255,255,255,0.07); }
.sidebar-link.active { background: #2D6BE4; color: #fff !important; }
.sidebar-link.active svg { color: #fff !important; }
.card { transition: box-shadow 0.18s, transform 0.18s; }
.card:hover { box-shadow: 0 8px 32px rgba(15,27,45,0.10); transform: translateY(-2px); }
[data-tab] { display: none; }
[data-tab].active { display: block; }
.stat-bar { transition: width 1s cubic-bezier(.4,0,.2,1); }
.tab-pill { transition: all 0.15s; cursor: pointer; }
.tab-pill.active { background: #2D6BE4; color: #fff; }
.progress-track { background: #E4E8F0; border-radius: 99px; overflow: hidden; }
.progress-fill { border-radius: 99px; transition: width 0.8s ease; }
::-webkit-scrollbar { width: 4px; } ::-webkit-scrollbar-thumb { background: #CBD3E0; border-radius: 9px; }
select { appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%236B7B93' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 10px center; }
.badge { font-family: 'Syne', sans-serif; font-size: 0.68rem; letter-spacing: 0.06em; text-transform: uppercase; }
.stat-card-icon { width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; }
.avatar { width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 600; font-family: 'Syne', sans-serif; flex-shrink: 0; }
.status-pill { border-radius: 99px; font-size: 11px; font-weight: 600; padding: 3px 10px; font-family: 'Syne', sans-serif; text-transform: uppercase; letter-spacing: 0.05em; }
.status-actif { background: #D1FAE5; color: #065F46; }
.status-termine { background: #DBEAFE; color: #1E40AF; }
.status-progression { background: #FEF3C7; color: #92400E; }
.status-difficulte { background: #FEE2E2; color: #991B1B; }
.status-suspendu { background: #F3F4F6; color: #374151; }
.status-averti { background: #FEF3C7; color: #92400E; }
.status-attente { background: #EDE9FE; color: #5B21B6; }
.donut-ring { transform: rotate(-90deg); transform-origin: center; }
.animate-in { animation: fadeUp 0.4s ease both; }
@keyframes fadeUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
.page-btn { width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 13px; cursor: pointer; transition: all 0.15s; font-family: 'Syne', sans-serif; font-weight: 600; }
.page-btn.cur { background: #2D6BE4; color: #fff; }
.page-btn:not(.cur):hover { background: #E4E8F0; }
</style>
</head>
<body class="min-h-screen flex">

<!-- =========== SIDEBAR =========== -->
<aside class="w-60 min-h-screen flex flex-col fixed top-0 left-0 z-30" style="background:#0F1B2D;">
  <div class="px-6 pt-7 pb-5" style="border-bottom:1px solid rgba(255,255,255,0.07);">
    <div class="flex items-center gap-3">
      <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:#2D6BE4;">
        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422A12.083 12.083 0 0112 21.5a12.083 12.083 0 01-6.16-3.922L12 14z"/></svg>
      </div>
      <div>
        <div class="font-display font-bold text-sm text-white leading-tight">Université Numérique</div>
        <div class="text-xs text-white/40 mt-0.5">Portail Enseignant</div>
      </div>
    </div>
  </div>
  <nav class="flex-1 px-4 py-5 space-y-1">
    <p class="text-white/30 text-xs font-display uppercase tracking-widest px-3 mb-3">Navigation</p>
    <a href="#" onclick="nav('tableau')" class="sidebar-link flex items-center gap-3 px-3 py-2.5 text-sm font-body font-medium text-white/60" data-nav="tableau">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1.5" stroke-width="2"/><rect x="14" y="3" width="7" height="7" rx="1.5" stroke-width="2"/><rect x="3" y="14" width="7" height="7" rx="1.5" stroke-width="2"/><rect x="14" y="14" width="7" height="7" rx="1.5" stroke-width="2"/></svg>
      Tableau de bord
    </a>
    <a href="#" onclick="nav('enseignements')" class="sidebar-link flex items-center gap-3 px-3 py-2.5 text-sm font-body font-medium text-white/60" data-nav="enseignements">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
      Mes Enseignements
    </a>
    <a href="#" onclick="nav('effectifs')" class="sidebar-link flex items-center gap-3 px-3 py-2.5 text-sm font-body font-medium text-white/60" data-nav="effectifs">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m6-4a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
      Effectifs
    </a>
    <a href="#" onclick="nav('classes')" class="sidebar-link flex items-center gap-3 px-3 py-2.5 text-sm font-body font-medium text-white/60" data-nav="classes">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/></svg>
      Classes
    </a>
    <a href="#" onclick="nav('suivi')" class="sidebar-link flex items-center gap-3 px-3 py-2.5 text-sm font-body font-medium text-white/60" data-nav="suivi">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
      Suivi pédagogique
    </a>
    <a href="#" class="sidebar-link flex items-center gap-3 px-3 py-2.5 text-sm font-body font-medium text-white/60" data-nav="messages">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
      Messages
      <span class="ml-auto w-5 h-5 rounded-full text-white text-xs flex items-center justify-center font-display font-bold" style="background:#2D6BE4; font-size:10px;">3</span>
    </a>
    <a href="#" class="sidebar-link flex items-center gap-3 px-3 py-2.5 text-sm font-body font-medium text-white/60">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><circle cx="12" cy="12" r="3" stroke-width="2"/></svg>
      Paramètres
    </a>
  </nav>
  <div class="px-5 py-4" style="border-top:1px solid rgba(255,255,255,0.07);">
    <div class="flex items-center gap-3">
      <div class="avatar text-white" style="background:#2D6BE4; width:36px; height:36px; font-size:13px;">AB</div>
      <div>
        <div class="text-sm font-display font-semibold text-white">Pr. Ahmed Benyahia</div>
        <div class="text-xs text-white/40">Professeur</div>
      </div>
      <svg class="w-4 h-4 text-white/30 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
    </div>
  </div>
</aside>

<!-- =========== MAIN =========== -->
<main class="ml-60 flex-1 min-h-screen">

  <!-- TOP BAR -->
  <header class="sticky top-0 z-20 flex items-center justify-between px-8 py-3.5" style="background:rgba(247,248,252,0.95); backdrop-filter:blur(12px); border-bottom:1px solid #E4E8F0;">
    <div class="flex items-center gap-3">
      <svg class="w-5 h-5 text-muted cursor-pointer" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
      <div class="flex items-center gap-2 px-3 py-1.5 rounded-lg border border-border bg-white text-sm font-body text-muted cursor-pointer hover:border-primary transition-colors">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" stroke-width="2"/><path d="M16 2v4M8 2v4M3 10h18" stroke-width="2"/></svg>
        Année universitaire 2024–2025
        <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6" stroke-width="2" stroke-linecap="round"/></svg>
      </div>
    </div>
    <div class="flex items-center gap-3">
      <div class="relative">
        <svg class="w-4 h-4 text-muted absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" stroke-width="2"/><path d="m21 21-4.35-4.35" stroke-width="2"/></svg>
        <input type="text" placeholder="Rechercher (cours, classe, étudiant...)" class="bg-white border border-border rounded-xl pl-9 pr-4 py-2 text-sm font-body w-72 placeholder:text-muted focus:outline-none focus:border-primary transition-colors"/>
      </div>
      <button class="relative w-9 h-9 rounded-xl border border-border bg-white flex items-center justify-center hover:border-primary transition-colors">
        <svg class="w-4 h-4 text-ink" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
        <span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full" style="background:#2D6BE4;"></span>
        <span class="absolute -top-0.5 -right-0.5 w-4 h-4 rounded-full bg-white flex items-center justify-center text-white font-display font-bold" style="background:#2D6BE4; font-size:9px;">2</span>
      </button>
      <div class="flex items-center gap-2 cursor-pointer">
        <div class="avatar text-white" style="background:#2D6BE4; width:34px; height:34px; font-size:12px;">AB</div>
        <span class="text-sm font-display font-semibold text-ink">Pr. Ahmed Benyahia</span>
        <svg class="w-3.5 h-3.5 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6" stroke-width="2" stroke-linecap="round"/></svg>
      </div>
    </div>
  </header>

  <div class="p-8">

    <!-- ========== PAGE: TABLEAU DE BORD ========== -->
    <div data-tab="tableau" class="active animate-in space-y-7">
      <div>
        <h1 class="font-display font-bold text-2xl text-ink">Tableau de bord</h1>
        <p class="text-sm text-muted mt-1">Bienvenue, Pr. Benyahia — voici un aperçu de vos activités ce semestre.</p>
      </div>
      <!-- Stats -->
      <div class="grid grid-cols-4 gap-5">
        <div class="card bg-white rounded-2xl p-5 border border-border">
          <div class="flex items-start justify-between mb-4">
            <div class="stat-card-icon" style="background:#EEF4FF;"><svg class="w-5 h-5" style="color:#2D6BE4;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg></div>
            <span class="badge px-2 py-0.5 rounded-lg" style="background:#EEF4FF; color:#2D6BE4;">Ce sem.</span>
          </div>
          <div class="font-display font-bold text-3xl text-ink">5</div>
          <div class="text-sm text-muted mt-0.5">Cours assignés</div>
        </div>
        <div class="card bg-white rounded-2xl p-5 border border-border">
          <div class="flex items-start justify-between mb-4">
            <div class="stat-card-icon" style="background:#ECFDF5;"><svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m6-4a4 4 0 11-8 0 4 4 0 018 0z"/></svg></div>
            <span class="badge px-2 py-0.5 rounded-lg" style="background:#ECFDF5; color:#059669;">+8%</span>
          </div>
          <div class="font-display font-bold text-3xl text-ink">328</div>
          <div class="text-sm text-muted mt-0.5">Étudiants au total</div>
        </div>
        <div class="card bg-white rounded-2xl p-5 border border-border">
          <div class="flex items-start justify-between mb-4">
            <div class="stat-card-icon" style="background:#FFF7ED;"><svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/></svg></div>
            <span class="badge px-2 py-0.5 rounded-lg" style="background:#FFF7ED; color:#EA580C;">6 niv.</span>
          </div>
          <div class="font-display font-bold text-3xl text-ink">6</div>
          <div class="text-sm text-muted mt-0.5">Classes</div>
        </div>
        <div class="card bg-white rounded-2xl p-5 border border-border">
          <div class="flex items-start justify-between mb-4">
            <div class="stat-card-icon" style="background:#F5F3FF;"><svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
            <span class="badge px-2 py-0.5 rounded-lg" style="background:#F5F3FF; color:#7C3AED;">Moy.</span>
          </div>
          <div class="font-display font-bold text-3xl text-ink">78%</div>
          <div class="text-sm text-muted mt-0.5">Taux de complétion</div>
        </div>
      </div>
      <!-- Cours rapide + répartition -->
      <div class="grid grid-cols-3 gap-6">
        <div class="col-span-2 bg-white rounded-2xl border border-border p-6">
          <div class="flex items-center justify-between mb-5">
            <h2 class="font-display font-semibold text-base">Mes cours — progression</h2>
            <button onclick="nav('enseignements')" class="text-xs font-display font-semibold px-3 py-1.5 rounded-lg border border-border hover:border-primary hover:text-primary transition-colors text-muted">Voir tout →</button>
          </div>
          <div class="space-y-4">
            <div class="flex items-center gap-4">
              <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0" style="background:#EEF4FF;"><svg class="w-4 h-4" style="color:#2D6BE4;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18" stroke-width="2" stroke-linecap="round"/></svg></div>
              <div class="flex-1">
                <div class="flex justify-between text-sm mb-1.5"><span class="font-medium">Algorithmique <span class="text-muted font-normal">· INFO101</span></span><span class="font-display font-bold text-ink">82%</span></div>
                <div class="progress-track h-2"><div class="progress-fill h-full" style="width:82%; background:#2D6BE4;"></div></div>
              </div>
              <span class="text-xs text-muted w-14 text-right">68 ét.</span>
            </div>
            <div class="flex items-center gap-4">
              <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0" style="background:#ECFDF5;"><svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><ellipse cx="12" cy="12" rx="9" ry="6" stroke-width="2"/><path d="M3 12c0 3.314 4.03 6 9 6s9-2.686 9-6" stroke-width="2"/></svg></div>
              <div class="flex-1">
                <div class="flex justify-between text-sm mb-1.5"><span class="font-medium">Base de données <span class="text-muted font-normal">· INFO203</span></span><span class="font-display font-bold text-ink">75%</span></div>
                <div class="progress-track h-2"><div class="progress-fill h-full" style="width:75%; background:#10B981;"></div></div>
              </div>
              <span class="text-xs text-muted w-14 text-right">72 ét.</span>
            </div>
            <div class="flex items-center gap-4">
              <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0" style="background:#FFF7ED;"><svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"/><path d="M2 12h20M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z" stroke-width="2"/></svg></div>
              <div class="flex-1">
                <div class="flex justify-between text-sm mb-1.5"><span class="font-medium">Développement Web <span class="text-muted font-normal">· INFO205</span></span><span class="font-display font-bold text-ink">70%</span></div>
                <div class="progress-track h-2"><div class="progress-fill h-full" style="width:70%; background:#F97316;"></div></div>
              </div>
              <span class="text-xs text-muted w-14 text-right">64 ét.</span>
            </div>
            <div class="flex items-center gap-4">
              <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0" style="background:#F5F3FF;"><svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0" stroke-width="2" stroke-linecap="round"/></svg></div>
              <div class="flex-1">
                <div class="flex justify-between text-sm mb-1.5"><span class="font-medium">Réseaux <span class="text-muted font-normal">· INFO301</span></span><span class="font-display font-bold text-ink">77%</span></div>
                <div class="progress-track h-2"><div class="progress-fill h-full" style="width:77%; background:#8B5CF6;"></div></div>
              </div>
              <span class="text-xs text-muted w-14 text-right">58 ét.</span>
            </div>
            <div class="flex items-center gap-4">
              <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0" style="background:#FEF3F2;"><svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z" stroke-width="2"/></svg></div>
              <div class="flex-1">
                <div class="flex justify-between text-sm mb-1.5"><span class="font-medium">Intelligence Artificielle <span class="text-muted font-normal">· INFO403</span></span><span class="font-display font-bold text-ink">85%</span></div>
                <div class="progress-track h-2"><div class="progress-fill h-full" style="width:85%; background:#EF4444;"></div></div>
              </div>
              <span class="text-xs text-muted w-14 text-right">66 ét.</span>
            </div>
          </div>
        </div>
        <div class="bg-white rounded-2xl border border-border p-6 flex flex-col">
          <h2 class="font-display font-semibold text-base mb-5">Statuts étudiants</h2>
          <div class="flex-1 flex flex-col items-center justify-center">
            <svg width="140" height="140" viewBox="0 0 140 140">
              <circle cx="70" cy="70" r="52" fill="none" stroke="#E4E8F0" stroke-width="14"/>
              <circle cx="70" cy="70" r="52" fill="none" stroke="#2D6BE4" stroke-width="14" stroke-dasharray="206 120" stroke-linecap="round" class="donut-ring"/>
              <circle cx="70" cy="70" r="52" fill="none" stroke="#10B981" stroke-width="14" stroke-dasharray="53 273" stroke-dashoffset="-206" stroke-linecap="round" class="donut-ring"/>
              <circle cx="70" cy="70" r="52" fill="none" stroke="#F59E0B" stroke-width="14" stroke-dasharray="40 286" stroke-dashoffset="-259" stroke-linecap="round" class="donut-ring"/>
              <circle cx="70" cy="70" r="52" fill="none" stroke="#EF4444" stroke-width="14" stroke-dasharray="27 299" stroke-dashoffset="-299" stroke-linecap="round" class="donut-ring"/>
              <text x="70" y="66" text-anchor="middle" font-family="Syne,sans-serif" font-weight="700" font-size="20" fill="#0F1B2D">328</text>
              <text x="70" y="82" text-anchor="middle" font-family="DM Sans,sans-serif" font-size="10" fill="#6B7B93">étudiants</text>
            </svg>
          </div>
          <div class="space-y-2.5 mt-4">
            <div class="flex items-center justify-between text-sm">
              <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full" style="background:#2D6BE4;"></span><span class="text-muted">Actifs</span></div>
              <span class="font-display font-semibold">216 <span class="text-muted font-normal text-xs">66%</span></span>
            </div>
            <div class="flex items-center justify-between text-sm">
              <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-green-500"></span><span class="text-muted">Terminés</span></div>
              <span class="font-display font-semibold">57 <span class="text-muted font-normal text-xs">17.5%</span></span>
            </div>
            <div class="flex items-center justify-between text-sm">
              <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-amber-400"></span><span class="text-muted">En progression</span></div>
              <span class="font-display font-semibold">43 <span class="text-muted font-normal text-xs">13%</span></span>
            </div>
            <div class="flex items-center justify-between text-sm">
              <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-red-500"></span><span class="text-muted">À risque</span></div>
              <span class="font-display font-semibold">12 <span class="text-muted font-normal text-xs">3.5%</span></span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ========== PAGE: MES ENSEIGNEMENTS ========== -->
    <div data-tab="enseignements" class="space-y-7">
      <div>
        <h1 class="font-display font-bold text-2xl text-ink">Mes Enseignements</h1>
        <p class="text-sm text-muted mt-1">Consultez la liste exclusive des cours qui vous sont assignés</p>
      </div>
      <div class="grid grid-cols-4 gap-5">
        <div class="bg-white rounded-2xl border border-border p-5">
          <div class="stat-card-icon mb-3" style="background:#EEF4FF;"><svg class="w-5 h-5" style="color:#2D6BE4;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg></div>
          <div class="font-display font-bold text-2xl text-ink">5</div>
          <div class="text-sm text-muted">Cours assignés</div>
          <div class="text-xs text-muted mt-0.5">Ce semestre</div>
        </div>
        <div class="bg-white rounded-2xl border border-border p-5">
          <div class="stat-card-icon mb-3" style="background:#ECFDF5;"><svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m6-4a4 4 0 11-8 0 4 4 0 018 0z"/></svg></div>
          <div class="font-display font-bold text-2xl text-ink">328</div>
          <div class="text-sm text-muted">Étudiants au total</div>
          <div class="text-xs text-muted mt-0.5">Across all courses</div>
        </div>
        <div class="bg-white rounded-2xl border border-border p-5">
          <div class="stat-card-icon mb-3" style="background:#FFF7ED;"><svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/></svg></div>
          <div class="font-display font-bold text-2xl text-ink">6</div>
          <div class="text-sm text-muted">Classes</div>
          <div class="text-xs text-muted mt-0.5">Ce semestre</div>
        </div>
        <div class="bg-white rounded-2xl border border-border p-5">
          <div class="stat-card-icon mb-3" style="background:#F5F3FF;"><svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
          <div class="font-display font-bold text-2xl text-ink">78%</div>
          <div class="text-sm text-muted">Taux de complétion</div>
          <div class="text-xs text-muted mt-0.5">Moyenne globale</div>
        </div>
      </div>
      <!-- Filters + Table -->
      <div class="bg-white rounded-2xl border border-border overflow-hidden">
        <div class="px-6 py-4 flex items-center gap-3 border-b border-border">
          <div class="relative flex-1 max-w-xs">
            <svg class="w-4 h-4 text-muted absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" stroke-width="2"/><path d="m21 21-4.35-4.35" stroke-width="2"/></svg>
            <input type="text" placeholder="Rechercher un cours..." class="border border-border rounded-lg pl-9 pr-4 py-2 text-sm w-full focus:outline-none focus:border-primary"/>
          </div>
          <select class="border border-border rounded-lg px-3 py-2 text-sm text-muted focus:outline-none focus:border-primary pr-8 bg-white"><option>Tous semestres</option><option>S1</option><option>S2</option><option>S3</option><option>S4</option></select>
          <select class="border border-border rounded-lg px-3 py-2 text-sm text-muted focus:outline-none focus:border-primary pr-8 bg-white"><option>Toutes classes</option><option>L1-INFO-A</option><option>L2-INFO-A</option><option>L2-INFO-B</option></select>
          <select class="border border-border rounded-lg px-3 py-2 text-sm text-muted focus:outline-none focus:border-primary pr-8 bg-white"><option>Tous statuts</option><option>En cours</option><option>Terminé</option></select>
          <button class="ml-auto flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-display font-semibold text-white" style="background:#2D6BE4;">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            Exporter
          </button>
        </div>
        <table class="w-full">
          <thead><tr style="background:#F7F8FC; border-bottom:1px solid #E4E8F0;">
            <th class="text-left px-6 py-3 text-xs font-display font-semibold text-muted uppercase tracking-wide">Cours</th>
            <th class="text-left px-4 py-3 text-xs font-display font-semibold text-muted uppercase tracking-wide">Code</th>
            <th class="text-left px-4 py-3 text-xs font-display font-semibold text-muted uppercase tracking-wide">Semestre</th>
            <th class="text-left px-4 py-3 text-xs font-display font-semibold text-muted uppercase tracking-wide">Classe</th>
            <th class="text-left px-4 py-3 text-xs font-display font-semibold text-muted uppercase tracking-wide">Nb inscrits</th>
            <th class="text-left px-4 py-3 text-xs font-display font-semibold text-muted uppercase tracking-wide">Progression</th>
            <th class="text-right px-6 py-3 text-xs font-display font-semibold text-muted uppercase tracking-wide">Actions</th>
          </tr></thead>
          <tbody class="divide-y divide-border">
            <tr class="hover:bg-paper transition-colors">
              <td class="px-6 py-4"><div class="flex items-center gap-3"><div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:#EEF4FF;"><svg class="w-4 h-4" style="color:#2D6BE4;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18" stroke-width="2" stroke-linecap="round"/></svg></div><div><div class="font-medium text-sm">Algorithmique</div><div class="text-xs text-muted">Structures de données et algorithmes</div></div></div></td>
              <td class="px-4 py-4"><span class="badge px-2 py-0.5 rounded-md" style="background:#EEF4FF; color:#2D6BE4;">INFO101</span></td>
              <td class="px-4 py-4"><span class="badge px-2 py-1 rounded-md" style="background:#ECFDF5; color:#065F46;">S1</span></td>
              <td class="px-4 py-4 text-sm text-ink">L1–INFO–A</td>
              <td class="px-4 py-4 text-sm"><div class="flex items-center gap-1.5"><svg class="w-3.5 h-3.5 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m6-4a4 4 0 11-8 0 4 4 0 018 0z"/></svg>68</div></td>
              <td class="px-4 py-4"><div class="flex items-center gap-2"><div class="flex-1 progress-track h-1.5" style="width:80px;"><div class="progress-fill h-full" style="width:82%; background:#2D6BE4;"></div></div><span class="text-sm font-display font-semibold">82%</span></div></td>
              <td class="px-6 py-4 text-right"><button onclick="nav('effectifs')" class="text-xs font-display font-semibold px-3 py-1.5 rounded-lg border border-border hover:border-primary hover:text-primary transition-colors text-muted">Voir les étudiants →</button></td>
            </tr>
            <tr class="hover:bg-paper transition-colors">
              <td class="px-6 py-4"><div class="flex items-center gap-3"><div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:#ECFDF5;"><svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><ellipse cx="12" cy="12" rx="9" ry="6" stroke-width="2"/><path d="M3 12c0 3.314 4.03 6 9 6s9-2.686 9-6" stroke-width="2"/></svg></div><div><div class="font-medium text-sm">Base de données</div><div class="text-xs text-muted">Modélisation et SQL</div></div></div></td>
              <td class="px-4 py-4"><span class="badge px-2 py-0.5 rounded-md" style="background:#ECFDF5; color:#059669;">INFO203</span></td>
              <td class="px-4 py-4"><span class="badge px-2 py-1 rounded-md" style="background:#EEF4FF; color:#1D4ED8;">S2</span></td>
              <td class="px-4 py-4 text-sm text-ink">L2–INFO–B</td>
              <td class="px-4 py-4 text-sm"><div class="flex items-center gap-1.5"><svg class="w-3.5 h-3.5 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m6-4a4 4 0 11-8 0 4 4 0 018 0z"/></svg>72</div></td>
              <td class="px-4 py-4"><div class="flex items-center gap-2"><div class="flex-1 progress-track h-1.5" style="width:80px;"><div class="progress-fill h-full" style="width:75%; background:#10B981;"></div></div><span class="text-sm font-display font-semibold">75%</span></div></td>
              <td class="px-6 py-4 text-right"><button onclick="nav('effectifs')" class="text-xs font-display font-semibold px-3 py-1.5 rounded-lg border border-border hover:border-primary hover:text-primary transition-colors text-muted">Voir les étudiants →</button></td>
            </tr>
            <tr class="hover:bg-paper transition-colors">
              <td class="px-6 py-4"><div class="flex items-center gap-3"><div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:#FFF7ED;"><svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"/><path d="M2 12h20M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z" stroke-width="2"/></svg></div><div><div class="font-medium text-sm">Développement Web</div><div class="text-xs text-muted">HTML, CSS, JavaScript, PHP</div></div></div></td>
              <td class="px-4 py-4"><span class="badge px-2 py-0.5 rounded-md" style="background:#FFF7ED; color:#EA580C;">INFO205</span></td>
              <td class="px-4 py-4"><span class="badge px-2 py-1 rounded-md" style="background:#EEF4FF; color:#1D4ED8;">S2</span></td>
              <td class="px-4 py-4 text-sm text-ink">L2–INFO–A</td>
              <td class="px-4 py-4 text-sm"><div class="flex items-center gap-1.5"><svg class="w-3.5 h-3.5 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m6-4a4 4 0 11-8 0 4 4 0 018 0z"/></svg>64</div></td>
              <td class="px-4 py-4"><div class="flex items-center gap-2"><div class="flex-1 progress-track h-1.5" style="width:80px;"><div class="progress-fill h-full" style="width:70%; background:#F97316;"></div></div><span class="text-sm font-display font-semibold">70%</span></div></td>
              <td class="px-6 py-4 text-right"><button onclick="nav('effectifs')" class="text-xs font-display font-semibold px-3 py-1.5 rounded-lg border border-border hover:border-primary hover:text-primary transition-colors text-muted">Voir les étudiants →</button></td>
            </tr>
            <tr class="hover:bg-paper transition-colors">
              <td class="px-6 py-4"><div class="flex items-center gap-3"><div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:#F5F3FF;"><svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0" stroke-width="2" stroke-linecap="round"/></svg></div><div><div class="font-medium text-sm">Réseaux</div><div class="text-xs text-muted">Réseaux informatiques et TCP/IP</div></div></div></td>
              <td class="px-4 py-4"><span class="badge px-2 py-0.5 rounded-md" style="background:#F5F3FF; color:#7C3AED;">INFO301</span></td>
              <td class="px-4 py-4"><span class="badge px-2 py-1 rounded-md" style="background:#FFF7ED; color:#C2410C;">S3</span></td>
              <td class="px-4 py-4 text-sm text-ink">L3–INFO–A</td>
              <td class="px-4 py-4 text-sm"><div class="flex items-center gap-1.5"><svg class="w-3.5 h-3.5 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m6-4a4 4 0 11-8 0 4 4 0 018 0z"/></svg>58</div></td>
              <td class="px-4 py-4"><div class="flex items-center gap-2"><div class="flex-1 progress-track h-1.5" style="width:80px;"><div class="progress-fill h-full" style="width:77%; background:#8B5CF6;"></div></div><span class="text-sm font-display font-semibold">77%</span></div></td>
              <td class="px-6 py-4 text-right"><button onclick="nav('effectifs')" class="text-xs font-display font-semibold px-3 py-1.5 rounded-lg border border-border hover:border-primary hover:text-primary transition-colors text-muted">Voir les étudiants →</button></td>
            </tr>
            <tr class="hover:bg-paper transition-colors">
              <td class="px-6 py-4"><div class="flex items-center gap-3"><div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:#FEF3F2;"><svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z" stroke-width="2"/></svg></div><div><div class="font-medium text-sm">Intelligence Artificielle</div><div class="text-xs text-muted">Introduction à l'IA et au Machine Learning</div></div></div></td>
              <td class="px-4 py-4"><span class="badge px-2 py-0.5 rounded-md" style="background:#FEF3F2; color:#DC2626;">INFO403</span></td>
              <td class="px-4 py-4"><span class="badge px-2 py-1 rounded-md" style="background:#F5F3FF; color:#6D28D9;">S4</span></td>
              <td class="px-4 py-4 text-sm text-ink">L3–INFO–B</td>
              <td class="px-4 py-4 text-sm"><div class="flex items-center gap-1.5"><svg class="w-3.5 h-3.5 text-muted" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m6-4a4 4 0 11-8 0 4 4 0 018 0z"/></svg>66</div></td>
              <td class="px-4 py-4"><div class="flex items-center gap-2"><div class="flex-1 progress-track h-1.5" style="width:80px;"><div class="progress-fill h-full" style="width:85%; background:#EF4444;"></div></div><span class="text-sm font-display font-semibold">85%</span></div></td>
              <td class="px-6 py-4 text-right"><button onclick="nav('effectifs')" class="text-xs font-display font-semibold px-3 py-1.5 rounded-lg border border-border hover:border-primary hover:text-primary transition-colors text-muted">Voir les étudiants →</button></td>
            </tr>
          </tbody>
        </table>
        <div class="px-6 py-3.5 border-t border-border flex items-center justify-between">
          <span class="text-sm text-muted">Affichage de 1 à 5 sur 5 cours</span>
          <div class="flex items-center gap-1">
            <div class="page-btn text-muted"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke-width="2" stroke-linecap="round"/></svg></div>
            <div class="page-btn cur">1</div>
            <div class="page-btn text-muted"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round"/></svg></div>
          </div>
        </div>
      </div>
    </div>

    <!-- ========== PAGE: EFFECTIFS ========== -->
    <div data-tab="effectifs" class="space-y-7">
      <div>
        <h1 class="font-display font-bold text-2xl text-ink">Gestion des Effectifs</h1>
        <p class="text-sm text-muted mt-1">Affichez la liste des étudiants inscrits à chacun de vos cours</p>
      </div>
      <div class="grid grid-cols-4 gap-5">
        <div class="bg-white rounded-2xl border border-border p-5"><div class="stat-card-icon mb-3" style="background:#EEF4FF;"><svg class="w-5 h-5" style="color:#2D6BE4;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m6-4a4 4 0 11-8 0 4 4 0 018 0z"/></svg></div><div class="font-display font-bold text-2xl text-ink">72</div><div class="text-sm text-muted">Étudiants inscrits</div><div class="text-xs text-muted mt-0.5">Total pour ce cours</div></div>
        <div class="bg-white rounded-2xl border border-border p-5"><div class="stat-card-icon mb-3" style="background:#ECFDF5;"><svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg></div><div class="font-display font-bold text-2xl text-ink">6</div><div class="text-sm text-muted">Cours actifs</div><div class="text-xs text-muted mt-0.5">Ce semestre</div></div>
        <div class="bg-white rounded-2xl border border-border p-5"><div class="stat-card-icon mb-3" style="background:#FFF7ED;"><svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div><div class="font-display font-bold text-2xl text-ink">84%</div><div class="text-sm text-muted">Présence moyenne</div><div class="text-xs text-muted mt-0.5">Pour ce cours</div></div>
        <div class="bg-white rounded-2xl border border-border p-5"><div class="stat-card-icon mb-3" style="background:#F5F3FF;"><svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg></div><div class="font-display font-bold text-2xl text-ink">4</div><div class="text-sm text-muted">Demandes en attente</div><div class="text-xs text-muted mt-0.5">Inscriptions / Transferts</div></div>
      </div>
      <!-- Course tabs -->
      <div class="bg-white rounded-2xl border border-border overflow-hidden">
        <div class="px-6 pt-5 border-b border-border">
          <div class="flex items-center gap-2 mb-4">
            <button class="tab-pill active flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-display font-semibold border border-transparent" style="">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18" stroke-width="2" stroke-linecap="round"/></svg>
              Algorithmique
            </button>
            <button class="tab-pill flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-display font-semibold text-muted border border-border hover:border-primary transition-colors">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><ellipse cx="12" cy="12" rx="9" ry="6" stroke-width="2"/><path d="M3 12c0 3.314 4.03 6 9 6s9-2.686 9-6" stroke-width="2"/></svg>
              Base de données
            </button>
            <button class="tab-pill flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-display font-semibold text-muted border border-border hover:border-primary transition-colors">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"/><path d="M2 12h20M12 2a15.3 15.3 0 014 10 15.3 15.3 0 01-4 10 15.3 15.3 0 01-4-10 15.3 15.3 0 014-10z" stroke-width="2"/></svg>
              Développement Web
            </button>
            <button class="tab-pill flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-display font-semibold text-muted border border-border hover:border-primary transition-colors">
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0" stroke-width="2" stroke-linecap="round"/></svg>
              Réseaux
            </button>
          </div>
          <div class="flex items-center gap-3 pb-4">
            <div class="relative"><svg class="w-4 h-4 text-muted absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" stroke-width="2"/><path d="m21 21-4.35-4.35" stroke-width="2"/></svg><input type="text" placeholder="Rechercher un étudiant..." class="border border-border rounded-lg pl-9 pr-4 py-2 text-sm focus:outline-none focus:border-primary w-56"/></div>
            <select class="border border-border rounded-lg px-3 py-2 text-sm text-muted focus:outline-none focus:border-primary pr-8 bg-white"><option>Tous statuts</option></select>
            <select class="border border-border rounded-lg px-3 py-2 text-sm text-muted focus:outline-none focus:border-primary pr-8 bg-white"><option>Toutes classes</option></select>
            <select class="border border-border rounded-lg px-3 py-2 text-sm text-muted focus:outline-none focus:border-primary pr-8 bg-white"><option>Tous statuts d'inscription</option></select>
            <button class="ml-auto flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-display font-semibold border border-border text-muted hover:border-primary hover:text-primary transition-colors">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
              Actualiser
            </button>
            <button class="flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-display font-semibold text-white" style="background:#2D6BE4;">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
              Exporter
            </button>
          </div>
        </div>
        <table class="w-full">
          <thead><tr style="background:#F7F8FC; border-bottom:1px solid #E4E8F0;">
            <th class="text-left px-6 py-3 text-xs font-display font-semibold text-muted uppercase tracking-wide">Matricule</th>
            <th class="text-left px-4 py-3 text-xs font-display font-semibold text-muted uppercase tracking-wide">Nom complet</th>
            <th class="text-left px-4 py-3 text-xs font-display font-semibold text-muted uppercase tracking-wide">Email</th>
            <th class="text-left px-4 py-3 text-xs font-display font-semibold text-muted uppercase tracking-wide">Classe</th>
            <th class="text-left px-4 py-3 text-xs font-display font-semibold text-muted uppercase tracking-wide">Date d'inscription</th>
            <th class="text-left px-4 py-3 text-xs font-display font-semibold text-muted uppercase tracking-wide">Présence</th>
            <th class="text-left px-4 py-3 text-xs font-display font-semibold text-muted uppercase tracking-wide">Statut</th>
            <th class="text-right px-6 py-3 text-xs font-display font-semibold text-muted uppercase tracking-wide">Actions</th>
          </tr></thead>
          <tbody class="divide-y divide-border text-sm">
            <tr class="hover:bg-paper transition-colors"><td class="px-6 py-3.5 text-muted font-mono text-xs">INF20230101</td><td class="px-4 py-3.5"><div class="flex items-center gap-2.5"><div class="avatar text-white" style="background:#2D6BE4; width:28px; height:28px; font-size:10px;">AA</div>Amina Ait Kaci</div></td><td class="px-4 py-3.5 text-muted">amina.aitkaci@etu.univ.tn</td><td class="px-4 py-3.5"><span class="badge px-2 py-0.5 rounded-md" style="background:#EEF4FF; color:#2D6BE4;">L2-INFO-B</span></td><td class="px-4 py-3.5 text-muted">15/09/2024</td><td class="px-4 py-3.5"><div class="flex items-center gap-2"><div class="progress-track h-1.5" style="width:60px;"><div class="progress-fill h-full" style="width:92%; background:#10B981;"></div></div><span>92%</span></div></td><td class="px-4 py-3.5"><span class="status-pill status-actif">Actif</span></td><td class="px-6 py-3.5 text-right flex items-center justify-end gap-2"><button class="text-xs font-display font-semibold px-2.5 py-1.5 rounded-lg border border-border hover:border-primary hover:text-primary transition-colors text-muted">Voir profil</button><button class="text-xs font-display font-semibold px-2.5 py-1.5 rounded-lg border border-border hover:border-primary hover:text-primary transition-colors text-muted">Contacter</button></td></tr>
            <tr class="hover:bg-paper transition-colors"><td class="px-6 py-3.5 text-muted font-mono text-xs">INF20230108</td><td class="px-4 py-3.5"><div class="flex items-center gap-2.5"><div class="avatar text-white" style="background:#F97316; width:28px; height:28px; font-size:10px;">YM</div>Yassine Messaoudi</div></td><td class="px-4 py-3.5 text-muted">yassine.messaoudi@etu.univ.tn</td><td class="px-4 py-3.5"><span class="badge px-2 py-0.5 rounded-md" style="background:#EEF4FF; color:#2D6BE4;">L2-INFO-B</span></td><td class="px-4 py-3.5 text-muted">16/09/2024</td><td class="px-4 py-3.5"><div class="flex items-center gap-2"><div class="progress-track h-1.5" style="width:60px;"><div class="progress-fill h-full" style="width:78%; background:#2D6BE4;"></div></div><span>78%</span></div></td><td class="px-4 py-3.5"><span class="status-pill status-actif">Actif</span></td><td class="px-6 py-3.5 text-right flex items-center justify-end gap-2"><button class="text-xs font-display font-semibold px-2.5 py-1.5 rounded-lg border border-border hover:border-primary hover:text-primary transition-colors text-muted">Voir profil</button><button class="text-xs font-display font-semibold px-2.5 py-1.5 rounded-lg border border-border hover:border-primary hover:text-primary transition-colors text-muted">Contacter</button></td></tr>
            <tr class="hover:bg-paper transition-colors"><td class="px-6 py-3.5 text-muted font-mono text-xs">INF20230115</td><td class="px-4 py-3.5"><div class="flex items-center gap-2.5"><div class="avatar text-white" style="background:#10B981; width:28px; height:28px; font-size:10px;">NR</div>Nourhane Rekik</div></td><td class="px-4 py-3.5 text-muted">nourhane.rekik@etu.univ.tn</td><td class="px-4 py-3.5"><span class="badge px-2 py-0.5 rounded-md" style="background:#EEF4FF; color:#2D6BE4;">L2-INFO-B</span></td><td class="px-4 py-3.5 text-muted">17/09/2024</td><td class="px-4 py-3.5"><div class="flex items-center gap-2"><div class="progress-track h-1.5" style="width:60px;"><div class="progress-fill h-full" style="width:88%; background:#10B981;"></div></div><span>88%</span></div></td><td class="px-4 py-3.5"><span class="status-pill status-actif">Actif</span></td><td class="px-6 py-3.5 text-right flex items-center justify-end gap-2"><button class="text-xs font-display font-semibold px-2.5 py-1.5 rounded-lg border border-border hover:border-primary hover:text-primary transition-colors text-muted">Voir profil</button><button class="text-xs font-display font-semibold px-2.5 py-1.5 rounded-lg border border-border hover:border-primary hover:text-primary transition-colors text-muted">Contacter</button></td></tr>
            <tr class="hover:bg-paper transition-colors"><td class="px-6 py-3.5 text-muted font-mono text-xs">INF20230122</td><td class="px-4 py-3.5"><div class="flex items-center gap-2.5"><div class="avatar text-white" style="background:#8B5CF6; width:28px; height:28px; font-size:10px;">MB</div>Mohamed Bouzid</div></td><td class="px-4 py-3.5 text-muted">mohamed.bouzid@etu.univ.tn</td><td class="px-4 py-3.5"><span class="badge px-2 py-0.5 rounded-md" style="background:#EEF4FF; color:#2D6BE4;">L2-INFO-B</span></td><td class="px-4 py-3.5 text-muted">18/09/2024</td><td class="px-4 py-3.5"><div class="flex items-center gap-2"><div class="progress-track h-1.5" style="width:60px;"><div class="progress-fill h-full" style="width:65%; background:#F59E0B;"></div></div><span>65%</span></div></td><td class="px-4 py-3.5"><span class="status-pill status-attente">En attente</span></td><td class="px-6 py-3.5 text-right flex items-center justify-end gap-2"><button class="text-xs font-display font-semibold px-2.5 py-1.5 rounded-lg border border-border hover:border-primary hover:text-primary transition-colors text-muted">Voir profil</button><button class="text-xs font-display font-semibold px-2.5 py-1.5 rounded-lg border border-border hover:border-primary hover:text-primary transition-colors text-muted">Contacter</button></td></tr>
            <tr class="hover:bg-paper transition-colors"><td class="px-6 py-3.5 text-muted font-mono text-xs">INF20230129</td><td class="px-4 py-3.5"><div class="flex items-center gap-2.5"><div class="avatar text-white" style="background:#EF4444; width:28px; height:28px; font-size:10px;">SK</div>Sara Khemiri</div></td><td class="px-4 py-3.5 text-muted">sara.khemiri@etu.univ.tn</td><td class="px-4 py-3.5"><span class="badge px-2 py-0.5 rounded-md" style="background:#EEF4FF; color:#2D6BE4;">L2-INFO-B</span></td><td class="px-4 py-3.5 text-muted">18/09/2024</td><td class="px-4 py-3.5"><div class="flex items-center gap-2"><div class="progress-track h-1.5" style="width:60px;"><div class="progress-fill h-full" style="width:90%; background:#10B981;"></div></div><span>90%</span></div></td><td class="px-4 py-3.5"><span class="status-pill status-actif">Actif</span></td><td class="px-6 py-3.5 text-right flex items-center justify-end gap-2"><button class="text-xs font-display font-semibold px-2.5 py-1.5 rounded-lg border border-border hover:border-primary hover:text-primary transition-colors text-muted">Voir profil</button><button class="text-xs font-display font-semibold px-2.5 py-1.5 rounded-lg border border-border hover:border-primary hover:text-primary transition-colors text-muted">Contacter</button></td></tr>
            <tr class="hover:bg-paper transition-colors"><td class="px-6 py-3.5 text-muted font-mono text-xs">INF20230207</td><td class="px-4 py-3.5"><div class="flex items-center gap-2.5"><div class="avatar text-white" style="background:#F97316; width:28px; height:28px; font-size:10px;">HL</div>Hedi Louati</div></td><td class="px-4 py-3.5 text-muted">hedi.louati@etu.univ.tn</td><td class="px-4 py-3.5"><span class="badge px-2 py-0.5 rounded-md" style="background:#EEF4FF; color:#2D6BE4;">L2-INFO-B</span></td><td class="px-4 py-3.5 text-muted">19/09/2024</td><td class="px-4 py-3.5"><div class="flex items-center gap-2"><div class="progress-track h-1.5" style="width:60px;"><div class="progress-fill h-full" style="width:82%; background:#2D6BE4;"></div></div><span>82%</span></div></td><td class="px-4 py-3.5"><span class="status-pill status-actif">Actif</span></td><td class="px-6 py-3.5 text-right flex items-center justify-end gap-2"><button class="text-xs font-display font-semibold px-2.5 py-1.5 rounded-lg border border-border hover:border-primary hover:text-primary transition-colors text-muted">Voir profil</button><button class="text-xs font-display font-semibold px-2.5 py-1.5 rounded-lg border border-border hover:border-primary hover:text-primary transition-colors text-muted">Contacter</button></td></tr>
            <tr class="hover:bg-paper transition-colors"><td class="px-6 py-3.5 text-muted font-mono text-xs">INF20230214</td><td class="px-4 py-3.5"><div class="flex items-center gap-2.5"><div class="avatar text-white" style="background:#8B5CF6; width:28px; height:28px; font-size:10px;">IB</div>Ines Ben Salem</div></td><td class="px-4 py-3.5 text-muted">ines.bensalem@etu.univ.tn</td><td class="px-4 py-3.5"><span class="badge px-2 py-0.5 rounded-md" style="background:#EEF4FF; color:#2D6BE4;">L2-INFO-B</span></td><td class="px-4 py-3.5 text-muted">20/09/2024</td><td class="px-4 py-3.5"><div class="flex items-center gap-2"><div class="progress-track h-1.5" style="width:60px;"><div class="progress-fill h-full" style="width:74%; background:#F59E0B;"></div></div><span>74%</span></div></td><td class="px-4 py-3.5"><span class="status-pill status-termine">Terminé</span></td><td class="px-6 py-3.5 text-right flex items-center justify-end gap-2"><button class="text-xs font-display font-semibold px-2.5 py-1.5 rounded-lg border border-border hover:border-primary hover:text-primary transition-colors text-muted">Voir profil</button><button class="text-xs font-display font-semibold px-2.5 py-1.5 rounded-lg border border-border hover:border-primary hover:text-primary transition-colors text-muted">Contacter</button></td></tr>
          </tbody>
        </table>
        <div class="px-6 py-3.5 border-t border-border flex items-center justify-between">
          <span class="text-sm text-muted">Affichage de 1 à 7 sur 72 étudiants</span>
          <div class="flex items-center gap-1">
            <div class="page-btn text-muted"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke-width="2" stroke-linecap="round"/></svg></div>
            <div class="page-btn cur">1</div>
            <div class="page-btn text-muted">2</div>
            <div class="page-btn text-muted">3</div>
            <div class="page-btn text-muted">…</div>
            <div class="page-btn text-muted">10</div>
            <div class="page-btn text-muted"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round"/></svg></div>
          </div>
        </div>
      </div>
    </div>

    <!-- ========== PAGE: CLASSES ========== -->
    <div data-tab="classes" class="space-y-7">
      <div>
        <h1 class="font-display font-bold text-2xl text-ink">Détails des Classes</h1>
        <p class="text-sm text-muted mt-1">Consultez la composition d'une classe spécifique et le nombre d'élèves à former</p>
      </div>
      <div class="grid grid-cols-4 gap-5">
        <div class="bg-white rounded-2xl border border-border p-5"><div class="flex items-center gap-3 mb-3"><div class="stat-card-icon" style="background:#EEF4FF;"><svg class="w-5 h-5" style="color:#2D6BE4;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/></svg></div></div><div class="text-xs text-muted mb-0.5">Classe sélectionnée</div><div class="font-display font-bold text-xl text-ink">L2-INFO-A</div><div class="text-xs text-muted mt-0.5">Classe actuelle</div></div>
        <div class="bg-white rounded-2xl border border-border p-5"><div class="stat-card-icon mb-3" style="background:#ECFDF5;"><svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m6-4a4 4 0 11-8 0 4 4 0 018 0z"/></svg></div><div class="text-xs text-muted mb-0.5">Effectif total</div><div class="font-display font-bold text-xl text-ink">64</div><div class="text-xs text-muted mt-0.5">Étudiants inscrits</div></div>
        <div class="bg-white rounded-2xl border border-border p-5"><div class="stat-card-icon mb-3" style="background:#F5F3FF;"><svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"/><path d="M12 8v4m0 4h.01" stroke-width="2" stroke-linecap="round"/></svg></div><div class="text-xs text-muted mb-0.5">Répartition H/F</div><div class="font-display font-bold text-xl text-ink">36 / 28</div><div class="text-xs text-muted mt-0.5">56% Hommes / 44% Femmes</div></div>
        <div class="bg-white rounded-2xl border border-border p-5"><div class="stat-card-icon mb-3" style="background:#ECFDF5;"><svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div><div class="text-xs text-muted mb-0.5">Taux de présence</div><div class="font-display font-bold text-xl text-ink">87%</div><div class="text-xs text-muted mt-0.5">Moyenne globale</div></div>
      </div>
      <div class="grid grid-cols-3 gap-6">
        <!-- Info + Donut -->
        <div class="space-y-5">
          <div class="bg-white rounded-2xl border border-border p-6">
            <h2 class="font-display font-semibold text-base mb-4">Informations de la classe</h2>
            <div class="space-y-3">
              <div class="flex items-center gap-3 text-sm"><svg class="w-4 h-4 text-muted flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/></svg><span class="text-muted w-28">Niveau</span><span class="font-medium">Licence 2</span></div>
              <div class="flex items-center gap-3 text-sm"><svg class="w-4 h-4 text-muted flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg><span class="text-muted w-28">Filière</span><span class="font-medium">Informatique</span></div>
              <div class="flex items-center gap-3 text-sm"><svg class="w-4 h-4 text-muted flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" stroke-width="2"/><path d="M16 2v4M8 2v4M3 10h18" stroke-width="2"/></svg><span class="text-muted w-28">Semestre</span><span class="font-medium">Semestre 2 <span class="badge px-1.5 py-0.5 rounded-md ml-1" style="background:#EEF4FF; color:#2D6BE4;">S2</span></span></div>
              <div class="flex items-center gap-3 text-sm"><svg class="w-4 h-4 text-muted flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg><span class="text-muted w-28">Salle principale</span><span class="font-medium">Salle 205 – Bât. A</span></div>
              <div class="flex items-center gap-3 text-sm"><svg class="w-4 h-4 text-muted flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg><span class="text-muted w-28">Délégué</span><span class="font-medium">Yassine Belkacem</span></div>
              <div class="flex items-center gap-3 text-sm"><svg class="w-4 h-4 text-muted flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m6-4a4 4 0 11-8 0 4 4 0 018 0z"/></svg><span class="text-muted w-28">Nb d'étudiants</span><span class="font-medium">64</span></div>
            </div>
          </div>
          <div class="bg-white rounded-2xl border border-border p-6">
            <h2 class="font-display font-semibold text-base mb-4">Répartition par genre</h2>
            <div class="flex items-center gap-6">
              <svg width="100" height="100" viewBox="0 0 100 100">
                <circle cx="50" cy="50" r="38" fill="none" stroke="#2D6BE4" stroke-width="16" stroke-dasharray="134 105" class="donut-ring"/>
                <circle cx="50" cy="50" r="38" fill="none" stroke="#8B5CF6" stroke-width="16" stroke-dasharray="105 134" stroke-dashoffset="-134" class="donut-ring"/>
                <text x="50" y="46" text-anchor="middle" font-family="Syne,sans-serif" font-weight="700" font-size="14" fill="#0F1B2D">64</text>
                <text x="50" y="60" text-anchor="middle" font-family="DM Sans,sans-serif" font-size="8" fill="#6B7B93">Étudiants</text>
              </svg>
              <div class="space-y-2">
                <div class="flex items-center gap-2 text-sm"><span class="w-2.5 h-2.5 rounded-full" style="background:#2D6BE4;"></span><span class="text-muted">Hommes</span><span class="font-display font-semibold ml-2">36 (56%)</span></div>
                <div class="flex items-center gap-2 text-sm"><span class="w-2.5 h-2.5 rounded-full" style="background:#8B5CF6;"></span><span class="text-muted">Femmes</span><span class="font-display font-semibold ml-2">28 (44%)</span></div>
              </div>
            </div>
          </div>
        </div>
        <!-- Cours + Student table -->
        <div class="col-span-2 space-y-5">
          <div class="bg-white rounded-2xl border border-border p-6">
            <h2 class="font-display font-semibold text-base mb-4">Cours de la classe</h2>
            <div class="space-y-2">
              <div class="flex items-center justify-between py-2 border-b border-border"><div class="flex items-center gap-3"><div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#EEF4FF;"><svg class="w-3.5 h-3.5" style="color:#2D6BE4;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18" stroke-width="2" stroke-linecap="round"/></svg></div><div><div class="text-sm font-medium">INFO101</div><div class="text-xs text-muted">Algorithmique</div></div></div><span class="badge px-2 py-0.5 rounded-md" style="background:#EEF4FF; color:#2D6BE4;">2 cours</span></div>
              <div class="flex items-center justify-between py-2 border-b border-border"><div class="flex items-center gap-3"><div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#ECFDF5;"><svg class="w-3.5 h-3.5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><ellipse cx="12" cy="12" rx="9" ry="6" stroke-width="2"/></svg></div><div><div class="text-sm font-medium">INFO203</div><div class="text-xs text-muted">Base de données</div></div></div><span class="badge px-2 py-0.5 rounded-md" style="background:#ECFDF5; color:#059669;">2 cours</span></div>
              <div class="flex items-center justify-between py-2 border-b border-border"><div class="flex items-center gap-3"><div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#FFF7ED;"><svg class="w-3.5 h-3.5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"/></svg></div><div><div class="text-sm font-medium">INFO205</div><div class="text-xs text-muted">Développement Web</div></div></div><span class="badge px-2 py-0.5 rounded-md" style="background:#FFF7ED; color:#EA580C;">2 cours</span></div>
              <div class="flex items-center justify-between py-2 border-b border-border"><div class="flex items-center gap-3"><div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#F5F3FF;"><svg class="w-3.5 h-3.5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M8.111 16.404a5.5 5.5 0 017.778 0" stroke-width="2"/></svg></div><div><div class="text-sm font-medium">INFO301</div><div class="text-xs text-muted">Réseaux</div></div></div><span class="badge px-2 py-0.5 rounded-md" style="background:#F5F3FF; color:#7C3AED;">2 cours</span></div>
              <div class="flex items-center justify-between py-2"><div class="flex items-center gap-3"><div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:#FEF3F2;"><svg class="w-3.5 h-3.5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z" stroke-width="2"/></svg></div><div><div class="text-sm font-medium">INFO403</div><div class="text-xs text-muted">Intelligence Artificielle</div></div></div><span class="badge px-2 py-0.5 rounded-md" style="background:#FEF3F2; color:#DC2626;">2 cours</span></div>
            </div>
          </div>
          <!-- Student list -->
          <div class="bg-white rounded-2xl border border-border overflow-hidden">
            <div class="px-5 py-4 border-b border-border flex items-center gap-3">
              <div class="relative flex-1"><svg class="w-4 h-4 text-muted absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8" stroke-width="2"/><path d="m21 21-4.35-4.35" stroke-width="2"/></svg><input type="text" placeholder="Rechercher un étudiant..." class="border border-border rounded-lg pl-9 pr-4 py-2 text-sm w-full focus:outline-none focus:border-primary"/></div>
              <select class="border border-border rounded-lg px-3 py-2 text-sm text-muted bg-white pr-8 focus:outline-none focus:border-primary"><option>Statut — Tous</option></select>
              <select class="border border-border rounded-lg px-3 py-2 text-sm text-muted bg-white pr-8 focus:outline-none focus:border-primary"><option>Genre — Tous</option></select>
              <button class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-display font-semibold text-white" style="background:#2D6BE4;"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>Exporter</button>
            </div>
            <table class="w-full text-sm">
              <thead><tr style="background:#F7F8FC; border-bottom:1px solid #E4E8F0;">
                <th class="text-left px-5 py-3 text-xs font-display font-semibold text-muted uppercase tracking-wide">Matricule</th>
                <th class="text-left px-4 py-3 text-xs font-display font-semibold text-muted uppercase tracking-wide">Nom</th>
                <th class="text-left px-4 py-3 text-xs font-display font-semibold text-muted uppercase tracking-wide">Spécialité</th>
                <th class="text-left px-4 py-3 text-xs font-display font-semibold text-muted uppercase tracking-wide">Assiduité</th>
                <th class="text-left px-4 py-3 text-xs font-display font-semibold text-muted uppercase tracking-wide">Statut</th>
                <th class="text-right px-5 py-3 text-xs font-display font-semibold text-muted uppercase tracking-wide">Actions</th>
              </tr></thead>
              <tbody class="divide-y divide-border">
                <tr class="hover:bg-paper transition-colors"><td class="px-5 py-3 text-muted font-mono text-xs">21213987</td><td class="px-4 py-3"><div class="flex items-center gap-2"><div class="avatar text-white" style="background:#2D6BE4; width:26px; height:26px; font-size:10px;">BY</div>Belkacem Yassine</div></td><td class="px-4 py-3 text-muted">Développement</td><td class="px-4 py-3"><div class="flex items-center gap-1.5"><div class="progress-track h-1.5" style="width:50px;"><div class="progress-fill h-full" style="width:92%; background:#10B981;"></div></div>92%</div></td><td class="px-4 py-3"><span class="status-pill status-actif">Actif</span></td><td class="px-5 py-3 text-right"><button class="text-xs font-display font-semibold px-2.5 py-1 rounded-lg border border-border hover:border-primary hover:text-primary transition-colors text-muted">Voir le profil</button></td></tr>
                <tr class="hover:bg-paper transition-colors"><td class="px-5 py-3 text-muted font-mono text-xs">21214563</td><td class="px-4 py-3"><div class="flex items-center gap-2"><div class="avatar text-white" style="background:#10B981; width:26px; height:26px; font-size:10px;">ML</div>Maâmar Lina</div></td><td class="px-4 py-3 text-muted">Réseaux</td><td class="px-4 py-3"><div class="flex items-center gap-1.5"><div class="progress-track h-1.5" style="width:50px;"><div class="progress-fill h-full" style="width:85%; background:#2D6BE4;"></div></div>85%</div></td><td class="px-4 py-3"><span class="status-pill status-actif">Actif</span></td><td class="px-5 py-3 text-right"><button class="text-xs font-display font-semibold px-2.5 py-1 rounded-lg border border-border hover:border-primary hover:text-primary transition-colors text-muted">Voir le profil</button></td></tr>
                <tr class="hover:bg-paper transition-colors"><td class="px-5 py-3 text-muted font-mono text-xs">21213321</td><td class="px-4 py-3"><div class="flex items-center gap-2"><div class="avatar text-white" style="background:#F97316; width:26px; height:26px; font-size:10px;">BO</div>Bouzid Omar</div></td><td class="px-4 py-3 text-muted">Développement</td><td class="px-4 py-3"><div class="flex items-center gap-1.5"><div class="progress-track h-1.5" style="width:50px;"><div class="progress-fill h-full" style="width:78%; background:#2D6BE4;"></div></div>78%</div></td><td class="px-4 py-3"><span class="status-pill status-actif">Actif</span></td><td class="px-5 py-3 text-right"><button class="text-xs font-display font-semibold px-2.5 py-1 rounded-lg border border-border hover:border-primary hover:text-primary transition-colors text-muted">Voir le profil</button></td></tr>
                <tr class="hover:bg-paper transition-colors"><td class="px-5 py-3 text-muted font-mono text-xs">21215044</td><td class="px-4 py-3"><div class="flex items-center gap-2"><div class="avatar text-white" style="background:#8B5CF6; width:26px; height:26px; font-size:10px;">KS</div>Khelifi Sara</div></td><td class="px-4 py-3 text-muted">Intelligence Art.</td><td class="px-4 py-3"><div class="flex items-center gap-1.5"><div class="progress-track h-1.5" style="width:50px;"><div class="progress-fill h-full" style="width:95%; background:#10B981;"></div></div>95%</div></td><td class="px-4 py-3"><span class="status-pill status-actif">Actif</span></td><td class="px-5 py-3 text-right"><button class="text-xs font-display font-semibold px-2.5 py-1 rounded-lg border border-border hover:border-primary hover:text-primary transition-colors text-muted">Voir le profil</button></td></tr>
                <tr class="hover:bg-paper transition-colors"><td class="px-5 py-3 text-muted font-mono text-xs">21212998</td><td class="px-4 py-3"><div class="flex items-center gap-2"><div class="avatar text-white" style="background:#EF4444; width:26px; height:26px; font-size:10px;">ZA</div>Zerrouki Amine</div></td><td class="px-4 py-3 text-muted">Systèmes & Réseaux</td><td class="px-4 py-3"><div class="flex items-center gap-1.5"><div class="progress-track h-1.5" style="width:50px;"><div class="progress-fill h-full" style="width:68%; background:#F59E0B;"></div></div>68%</div></td><td class="px-4 py-3"><span class="status-pill status-averti">Averti</span></td><td class="px-5 py-3 text-right"><button class="text-xs font-display font-semibold px-2.5 py-1 rounded-lg border border-border hover:border-primary hover:text-primary transition-colors text-muted">Voir le profil</button></td></tr>
              </tbody>
            </table>
            <div class="px-5 py-3 border-t border-border flex items-center justify-between">
              <span class="text-sm text-muted">Affichage de 1 à 5 sur 64 étudiants</span>
              <div class="flex items-center gap-1">
                <div class="page-btn text-muted"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke-width="2" stroke-linecap="round"/></svg></div>
                <div class="page-btn cur">1</div><div class="page-btn text-muted">2</div><div class="page-btn text-muted">3</div><div class="page-btn text-muted">…</div><div class="page-btn text-muted">13</div>
                <div class="page-btn text-muted"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round"/></svg></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ========== PAGE: SUIVI PÉDAGOGIQUE ========== -->
    <div data-tab="suivi" class="space-y-7">
      <div>
        <h1 class="font-display font-bold text-2xl text-ink">Suivi Pédagogique</h1>
        <p class="text-sm text-muted mt-1">Modifiez le statut des étudiants dans vos cours</p>
      </div>
      <div class="grid grid-cols-4 gap-5">
        <div class="bg-white rounded-2xl border border-border p-5"><div class="flex items-center gap-3 mb-2"><div class="stat-card-icon" style="background:#EEF4FF;"><svg class="w-5 h-5" style="color:#2D6BE4;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m6-4a4 4 0 11-8 0 4 4 0 018 0z"/></svg></div><span class="ml-auto text-xs text-muted font-display">66.0% du total</span></div><div class="font-display font-bold text-2xl text-ink">68</div><div class="text-sm text-muted">Étudiants actifs</div><div class="h-0.5 mt-3 rounded-full" style="background:#2D6BE4;"></div></div>
        <div class="bg-white rounded-2xl border border-border p-5"><div class="flex items-center gap-3 mb-2"><div class="stat-card-icon" style="background:#ECFDF5;"><svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div><span class="ml-auto text-xs text-muted font-display">17.5% du total</span></div><div class="font-display font-bold text-2xl text-ink">18</div><div class="text-sm text-muted">Terminés</div><div class="h-0.5 mt-3 rounded-full bg-green-500"></div></div>
        <div class="bg-white rounded-2xl border border-border p-5"><div class="flex items-center gap-3 mb-2"><div class="stat-card-icon" style="background:#FFF7ED;"><svg class="w-5 h-5 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg></div><span class="ml-auto text-xs text-muted font-display">12.6% du total</span></div><div class="font-display font-bold text-2xl text-ink">13</div><div class="text-sm text-muted">En progression</div><div class="h-0.5 mt-3 rounded-full bg-amber-400"></div></div>
        <div class="bg-white rounded-2xl border border-border p-5"><div class="flex items-center gap-3 mb-2"><div class="stat-card-icon" style="background:#FEF3F2;"><svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg></div><span class="ml-auto text-xs text-muted font-display">3.9% du total</span></div><div class="font-display font-bold text-2xl text-ink">4</div><div class="text-sm text-muted">À risque</div><div class="h-0.5 mt-3 rounded-full bg-red-500"></div></div>
      </div>
      <div class="grid grid-cols-3 gap-6">
        <!-- Main table -->
        <div class="col-span-2 bg-white rounded-2xl border border-border overflow-hidden">
          <div class="px-6 py-4 border-b border-border">
            <div class="flex items-center gap-3 justify-between">
              <div>
                <div class="flex items-center gap-3 mb-0.5">
                  <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:#FFF7ED;"><svg class="w-4 h-4 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" stroke-width="2"/></svg></div>
                  <div><div class="font-display font-semibold text-sm">Développement Web — L2-INFO-A</div><div class="flex items-center gap-3 text-xs text-muted mt-0.5"><span class="flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-5-3.87M9 20H4v-2a4 4 0 015-3.87m6-4a4 4 0 11-8 0 4 4 0 018 0z"/></svg>64 inscrits</span><span>Semestre 2</span><span class="status-pill status-actif">En cours</span></div></div>
                </div>
              </div>
              <button class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-display font-semibold border border-border text-muted hover:border-primary hover:text-primary transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/></svg>Filtres</button>
            </div>
          </div>
          <table class="w-full text-sm">
            <thead><tr style="background:#F7F8FC; border-bottom:1px solid #E4E8F0;">
              <th class="text-left px-5 py-3 text-xs font-display font-semibold text-muted uppercase tracking-wide">Étudiant</th>
              <th class="text-left px-4 py-3 text-xs font-display font-semibold text-muted uppercase tracking-wide">Cours</th>
              <th class="text-left px-4 py-3 text-xs font-display font-semibold text-muted uppercase tracking-wide">Progression</th>
              <th class="text-left px-4 py-3 text-xs font-display font-semibold text-muted uppercase tracking-wide">Dernière activité</th>
              <th class="text-left px-4 py-3 text-xs font-display font-semibold text-muted uppercase tracking-wide">Statut actuel</th>
              <th class="text-left px-4 py-3 text-xs font-display font-semibold text-muted uppercase tracking-wide">Nouveau statut</th>
              <th class="text-right px-5 py-3 text-xs font-display font-semibold text-muted uppercase tracking-wide">Actions</th>
            </tr></thead>
            <tbody class="divide-y divide-border">
              <tr class="hover:bg-paper transition-colors"><td class="px-5 py-3.5"><div class="flex items-center gap-2"><div class="avatar text-white" style="background:#2D6BE4; width:28px; height:28px; font-size:10px;">MA</div><div><div class="font-medium">Marouane Ali</div><div class="text-xs text-muted">INFO21045</div></div></div></td><td class="px-4 py-3.5"><div class="font-medium text-xs">Développement Web</div><div class="text-xs text-muted">L2-INFO-A</div></td><td class="px-4 py-3.5"><div class="flex items-center gap-1.5"><div class="progress-track h-1.5" style="width:50px;"><div class="progress-fill h-full" style="width:92%; background:#2D6BE4;"></div></div><span>92%</span></div></td><td class="px-4 py-3.5 text-xs text-muted">Aujourd'hui, 10:24</td><td class="px-4 py-3.5"><span class="status-pill status-actif">Actif</span></td><td class="px-4 py-3.5"><select class="border border-border rounded-lg px-2 py-1 text-xs bg-white focus:outline-none focus:border-primary pr-6"><option>Actif</option><option>Terminé</option><option>En progression</option><option>En difficulté</option></select></td><td class="px-5 py-3.5 text-right"><button class="text-xs font-display font-semibold px-3 py-1.5 rounded-lg text-white" style="background:#2D6BE4;">Enregistrer</button></td></tr>
              <tr class="hover:bg-paper transition-colors"><td class="px-5 py-3.5"><div class="flex items-center gap-2"><div class="avatar text-white" style="background:#10B981; width:28px; height:28px; font-size:10px;">SR</div><div><div class="font-medium">Sarah Rezki</div><div class="text-xs text-muted">INFO21067</div></div></div></td><td class="px-4 py-3.5"><div class="font-medium text-xs">Développement Web</div><div class="text-xs text-muted">L2-INFO-A</div></td><td class="px-4 py-3.5"><div class="flex items-center gap-1.5"><div class="progress-track h-1.5" style="width:50px;"><div class="progress-fill h-full" style="width:100%; background:#10B981;"></div></div><span>100%</span></div></td><td class="px-4 py-3.5 text-xs text-muted">Hier, 16:48</td><td class="px-4 py-3.5"><span class="status-pill status-termine">Terminé</span></td><td class="px-4 py-3.5"><select class="border border-border rounded-lg px-2 py-1 text-xs bg-white focus:outline-none focus:border-primary pr-6"><option>Terminé</option><option>Actif</option></select></td><td class="px-5 py-3.5 text-right"><button class="text-xs font-display font-semibold px-3 py-1.5 rounded-lg text-white" style="background:#2D6BE4;">Enregistrer</button></td></tr>
              <tr class="hover:bg-paper transition-colors"><td class="px-5 py-3.5"><div class="flex items-center gap-2"><div class="avatar text-white" style="background:#F59E0B; width:28px; height:28px; font-size:10px;">YM</div><div><div class="font-medium">Yacine Meftah</div><div class="text-xs text-muted">INFO21022</div></div></div></td><td class="px-4 py-3.5"><div class="font-medium text-xs">Développement Web</div><div class="text-xs text-muted">L2-INFO-A</div></td><td class="px-4 py-3.5"><div class="flex items-center gap-1.5"><div class="progress-track h-1.5" style="width:50px;"><div class="progress-fill h-full" style="width:58%; background:#F59E0B;"></div></div><span>58%</span></div></td><td class="px-4 py-3.5 text-xs text-muted">Hier, 09:15</td><td class="px-4 py-3.5"><span class="status-pill status-progression">En progression</span></td><td class="px-4 py-3.5"><select class="border border-border rounded-lg px-2 py-1 text-xs bg-white focus:outline-none focus:border-primary pr-6"><option>En progression</option><option>Actif</option></select></td><td class="px-5 py-3.5 text-right"><button class="text-xs font-display font-semibold px-3 py-1.5 rounded-lg text-white" style="background:#2D6BE4;">Enregistrer</button></td></tr>
              <tr class="hover:bg-paper transition-colors"><td class="px-5 py-3.5"><div class="flex items-center gap-2"><div class="avatar text-white" style="background:#EF4444; width:28px; height:28px; font-size:10px;">NK</div><div><div class="font-medium">Nadia Kaci</div><div class="text-xs text-muted">INFO21089</div></div></div></td><td class="px-4 py-3.5"><div class="font-medium text-xs">Développement Web</div><div class="text-xs text-muted">L2-INFO-A</div></td><td class="px-4 py-3.5"><div class="flex items-center gap-1.5"><div class="progress-track h-1.5" style="width:50px;"><div class="progress-fill h-full" style="width:28%; background:#EF4444;"></div></div><span>28%</span></div></td><td class="px-4 py-3.5 text-xs text-muted">12 mai 2025</td><td class="px-4 py-3.5"><span class="status-pill status-difficulte">En difficulté</span></td><td class="px-4 py-3.5"><select class="border border-border rounded-lg px-2 py-1 text-xs bg-white focus:outline-none focus:border-primary pr-6"><option>En difficulté</option><option>Actif</option></select></td><td class="px-5 py-3.5 text-right"><button class="text-xs font-display font-semibold px-3 py-1.5 rounded-lg text-white" style="background:#2D6BE4;">Enregistrer</button></td></tr>
              <tr class="hover:bg-paper transition-colors"><td class="px-5 py-3.5"><div class="flex items-center gap-2"><div class="avatar text-white" style="background:#6B7B93; width:28px; height:28px; font-size:10px;">AB</div><div><div class="font-medium">Amine Bounedjar</div><div class="text-xs text-muted">INFO21031</div></div></div></td><td class="px-4 py-3.5"><div class="font-medium text-xs">Développement Web</div><div class="text-xs text-muted">L2-INFO-A</div></td><td class="px-4 py-3.5"><div class="flex items-center gap-1.5"><div class="progress-track h-1.5" style="width:50px;"><div class="progress-fill h-full" style="width:0%; background:#6B7B93;"></div></div><span>0%</span></div></td><td class="px-4 py-3.5 text-xs text-muted">8 mai 2025</td><td class="px-4 py-3.5"><span class="status-pill status-suspendu">Suspendu</span></td><td class="px-4 py-3.5"><select class="border border-border rounded-lg px-2 py-1 text-xs bg-white focus:outline-none focus:border-primary pr-6"><option>Suspendu</option><option>Actif</option></select></td><td class="px-5 py-3.5 text-right"><button class="text-xs font-display font-semibold px-3 py-1.5 rounded-lg text-white" style="background:#2D6BE4;">Enregistrer</button></td></tr>
              <tr class="hover:bg-paper transition-colors"><td class="px-5 py-3.5"><div class="flex items-center gap-2"><div class="avatar text-white" style="background:#2D6BE4; width:28px; height:28px; font-size:10px;">CL</div><div><div class="font-medium">Chahinez Lalmi</div><div class="text-xs text-muted">INFO21073</div></div></div></td><td class="px-4 py-3.5"><div class="font-medium text-xs">Développement Web</div><div class="text-xs text-muted">L2-INFO-A</div></td><td class="px-4 py-3.5"><div class="flex items-center gap-1.5"><div class="progress-track h-1.5" style="width:50px;"><div class="progress-fill h-full" style="width:74%; background:#2D6BE4;"></div></div><span>74%</span></div></td><td class="px-4 py-3.5 text-xs text-muted">Aujourd'hui, 08:12</td><td class="px-4 py-3.5"><span class="status-pill status-actif">Actif</span></td><td class="px-4 py-3.5"><select class="border border-border rounded-lg px-2 py-1 text-xs bg-white focus:outline-none focus:border-primary pr-6"><option>Actif</option><option>Terminé</option></select></td><td class="px-5 py-3.5 text-right"><button class="text-xs font-display font-semibold px-3 py-1.5 rounded-lg text-white" style="background:#2D6BE4;">Enregistrer</button></td></tr>
              <tr class="hover:bg-paper transition-colors"><td class="px-5 py-3.5"><div class="flex items-center gap-2"><div class="avatar text-white" style="background:#F59E0B; width:28px; height:28px; font-size:10px;">HB</div><div><div class="font-medium">Hichem Belkacem</div><div class="text-xs text-muted">INFO21056</div></div></div></td><td class="px-4 py-3.5"><div class="font-medium text-xs">Développement Web</div><div class="text-xs text-muted">L2-INFO-A</div></td><td class="px-4 py-3.5"><div class="flex items-center gap-1.5"><div class="progress-track h-1.5" style="width:50px;"><div class="progress-fill h-full" style="width:41%; background:#F59E0B;"></div></div><span>41%</span></div></td><td class="px-4 py-3.5 text-xs text-muted">9 mai 2025</td><td class="px-4 py-3.5"><span class="status-pill status-progression">En progression</span></td><td class="px-4 py-3.5"><select class="border border-border rounded-lg px-2 py-1 text-xs bg-white focus:outline-none focus:border-primary pr-6"><option>En progression</option><option>Actif</option></select></td><td class="px-5 py-3.5 text-right"><button class="text-xs font-display font-semibold px-3 py-1.5 rounded-lg text-white" style="background:#2D6BE4;">Enregistrer</button></td></tr>
            </tbody>
          </table>
          <div class="px-5 py-3.5 border-t border-border flex items-center justify-between">
            <span class="text-sm text-muted">Affichage de 1 à 7 sur 64 étudiants</span>
            <div class="flex items-center gap-1">
              <div class="page-btn text-muted"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 19l-7-7 7-7" stroke-width="2" stroke-linecap="round"/></svg></div>
              <div class="page-btn cur">1</div><div class="page-btn text-muted">2</div><div class="page-btn text-muted">3</div><div class="page-btn text-muted">…</div><div class="page-btn text-muted">9</div>
              <div class="page-btn text-muted"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round"/></svg></div>
            </div>
          </div>
        </div>
        <!-- Side panel -->
        <div class="space-y-5">
          <div class="bg-white rounded-2xl border border-border p-5">
            <div class="flex items-center gap-2 mb-4">
              <svg class="w-4 h-4" style="color:#2D6BE4;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
              <h2 class="font-display font-semibold text-sm">Mise à jour du statut</h2>
            </div>
            <div class="flex items-center gap-3 mb-4">
              <div class="avatar text-white" style="background:#2D6BE4;">MA</div>
              <div><div class="font-medium text-sm">Marouane Ali</div><div class="text-xs text-muted">INFO21045</div></div>
            </div>
            <div class="flex items-center gap-3 mb-4">
              <div class="text-center"><div class="text-xs text-muted mb-1">Actuel</div><span class="status-pill status-actif">Actif</span></div>
              <svg class="w-4 h-4 text-muted mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7" stroke-width="2" stroke-linecap="round"/></svg>
              <div class="text-center"><div class="text-xs text-muted mb-1">Nouveau</div><span class="status-pill status-termine">Terminé</span></div>
            </div>
            <div class="border-t border-border pt-4 space-y-3">
              <h3 class="text-xs font-display font-semibold text-muted uppercase tracking-wide">Détails de la modification</h3>
              <div class="flex items-center justify-between text-xs"><span class="text-muted flex items-center gap-1.5"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" stroke-width="2"/><path d="M16 2v4M8 2v4M3 10h18" stroke-width="2"/></svg>Date</span><span class="font-medium">15 mai 2025, 11:32</span></div>
              <div class="flex items-center justify-between text-xs"><span class="text-muted flex items-center gap-1.5"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>Modifié par</span><span class="font-medium">Pr. Ahmed Benyahia</span></div>
              <div class="text-xs"><span class="text-muted flex items-center gap-1.5 mb-1"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>Motif (optionnel)</span><span class="text-ink">Étudiant a remis tous les projets et validé l'examen final.</span></div>
            </div>
            <div class="flex gap-2 mt-4">
              <button class="flex-1 py-2 rounded-lg text-sm font-display font-semibold border border-border text-muted hover:border-primary hover:text-primary transition-colors">Annuler</button>
              <button class="flex-1 py-2 rounded-lg text-sm font-display font-semibold text-white" style="background:#2D6BE4;">Confirmer</button>
            </div>
          </div>
          <div class="bg-white rounded-2xl border border-border p-5">
            <h2 class="font-display font-semibold text-sm mb-4">Aperçu du cours</h2>
            <div class="flex items-center gap-4">
              <svg width="80" height="80" viewBox="0 0 80 80">
                <circle cx="40" cy="40" r="30" fill="none" stroke="#E4E8F0" stroke-width="8"/>
                <circle cx="40" cy="40" r="30" fill="none" stroke="#2D6BE4" stroke-width="8" stroke-dasharray="125 63" class="donut-ring"/>
                <circle cx="40" cy="40" r="30" fill="none" stroke="#10B981" stroke-width="8" stroke-dasharray="28 160" stroke-dashoffset="-125" class="donut-ring"/>
                <circle cx="40" cy="40" r="30" fill="none" stroke="#F59E0B" stroke-width="8" stroke-dasharray="23 165" stroke-dashoffset="-153" class="donut-ring"/>
                <circle cx="40" cy="40" r="30" fill="none" stroke="#EF4444" stroke-width="8" stroke-dasharray="12 176" stroke-dashoffset="-176" class="donut-ring"/>
              </svg>
              <div class="space-y-1.5 text-xs">
                <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full" style="background:#2D6BE4;"></span><span class="text-muted">Actifs</span><span class="ml-auto font-semibold">68 (66.0%)</span></div>
                <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-green-500"></span><span class="text-muted">Terminés</span><span class="ml-auto font-semibold">18 (17.5%)</span></div>
                <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-amber-400"></span><span class="text-muted">En progression</span><span class="ml-auto font-semibold">13 (12.6%)</span></div>
                <div class="flex items-center gap-2"><span class="w-2 h-2 rounded-full bg-red-500"></span><span class="text-muted">À risque</span><span class="ml-auto font-semibold">4 (3.9%)</span></div>
              </div>
            </div>
            <button class="mt-4 w-full flex items-center justify-between text-xs font-display font-semibold px-3 py-2 rounded-lg border border-border hover:border-primary hover:text-primary transition-colors text-muted">Voir le rapport détaillé <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-width="2" stroke-linecap="round"/></svg></button>
          </div>
        </div>
      </div>
    </div>

  </div><!-- /p-8 -->
</main>

<script>
function nav(tab) {
  document.querySelectorAll('[data-tab]').forEach(el => el.classList.remove('active'));
  document.querySelectorAll('[data-nav]').forEach(el => {
    el.classList.remove('active');
    el.classList.add('text-white/60');
    el.classList.remove('text-white');
  });
  const content = document.querySelector('[data-tab="'+tab+'"]');
  if (content) { content.classList.add('active'); content.classList.add('animate-in'); }
  const navEl = document.querySelector('[data-nav="'+tab+'"]');
  if (navEl) {
    navEl.classList.add('active');
    navEl.classList.remove('text-white/60');
    navEl.classList.add('text-white');
  }
  return false;
}
nav('tableau');
</script>
</body>
</html>