<?php
use Cisse\CategorieProduitPoo\Core\Debug as DD;
$categories = $categorieRepository ?? [];
$produits = $produits ?? [];
//DD::dd($produits);

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits — Nova Store</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="produits.css">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=JetBrains+Mono:wght@400;500&display=swap');

/* ============================================================
   NOVA STORE — tokens
   ============================================================ */
:root{
  --void:        #060b09;
  --void-2:      #0a1712;
  --glass:       rgba(255,255,255,.045);
  --glass-hi:    rgba(255,255,255,.09);
  --border:      rgba(255,255,255,.09);
  --border-hi:   rgba(255,255,255,.18);

  --teal:        #14d8a0;
  --teal-soft:   rgba(20,216,160,.16);
  --violet:      #8b6bff;
  --violet-soft: rgba(139,107,255,.18);
  --ember:       #ff6b5b;
  --ember-soft:  rgba(255,107,91,.16);
  --amber:       #ffb84d;
  --amber-soft:  rgba(255,184,77,.16);

  --text-hi:     #eaf6f0;
  --text-mid:    #9fb3ab;
  --text-low:    #5e7168;

  --radius-lg:   22px;
  --radius-md:   14px;
  --radius-sm:   9px;

  --font-display: 'Space Grotesk', 'Inter', sans-serif;
  --font-body:    'Inter', sans-serif;
  --font-mono:    'JetBrains Mono', monospace;

  --ease: cubic-bezier(.22,1,.36,1);
}

/* ============================================================
   BASE
   ============================================================ */
*{ box-sizing:border-box; }

html{ color-scheme: dark; }

body{
  margin:0;
  min-height:100vh;
  background: var(--void);
  color: var(--text-hi);
  font-family: var(--font-body);
  display:flex;
  align-items:center;
  justify-content:center;
  padding: 56px 24px;
  overflow-x:hidden;
  position:relative;
}

::selection{ background: var(--teal-soft); color:#fff; }

::-webkit-scrollbar{ height:10px; width:10px; }
::-webkit-scrollbar-track{ background:transparent; }
::-webkit-scrollbar-thumb{ background: var(--border-hi); border-radius:20px; }
::-webkit-scrollbar-thumb:hover{ background: var(--teal); }

/* ============================================================
   SIGNATURE — aurora mesh + starfield
   ============================================================ */
.mesh-gradient{
  position:fixed;
  inset:-10%;
  z-index:0;
  pointer-events:none;
  background:
    radial-gradient(38% 32% at 18% 22%, rgba(20,216,160,.30) 0%, transparent 70%),
    radial-gradient(42% 36% at 82% 18%, rgba(139,107,255,.26) 0%, transparent 70%),
    radial-gradient(46% 40% at 50% 88%, rgba(255,107,91,.14) 0%, transparent 72%),
    radial-gradient(60% 60% at 50% 50%, var(--void-2) 0%, var(--void) 70%);
  filter: blur(60px) saturate(130%);
  animation: aurora-drift 22s ease-in-out infinite alternate;
}

@keyframes aurora-drift{
  0%{   transform: translate3d(0,0,0) scale(1); }
  50%{  transform: translate3d(-2%, 2%, 0) scale(1.06); }
  100%{ transform: translate3d(2%, -2%, 0) scale(1.02); }
}

.particles{
  position:fixed;
  inset:0;
  z-index:0;
  pointer-events:none;
  background-image:
    radial-gradient(1.5px 1.5px at 10% 20%, rgba(234,246,240,.55) 50%, transparent 100%),
    radial-gradient(1.5px 1.5px at 82% 15%, rgba(234,246,240,.4) 50%, transparent 100%),
    radial-gradient(1px 1px at 60% 70%, rgba(234,246,240,.5) 50%, transparent 100%),
    radial-gradient(1.5px 1.5px at 30% 82%, rgba(234,246,240,.35) 50%, transparent 100%),
    radial-gradient(1px 1px at 90% 60%, rgba(234,246,240,.45) 50%, transparent 100%),
    radial-gradient(1.5px 1.5px at 46% 38%, rgba(234,246,240,.4) 50%, transparent 100%),
    radial-gradient(1px 1px at 70% 92%, rgba(234,246,240,.35) 50%, transparent 100%),
    radial-gradient(1.5px 1.5px at 6% 60%, rgba(234,246,240,.4) 50%, transparent 100%);
  background-size: 600px 600px;
  animation: stars-drift 60s linear infinite;
  opacity:.8;
}

@keyframes stars-drift{
  from{ background-position: 0 0; }
  to{   background-position: -600px 400px; }
}

/* ============================================================
   CARD
   ============================================================ */
.card{
  position:relative;
  z-index:1;
  width:100%;
  max-width: 1040px;
  background: var(--glass);
  border: 1px solid var(--border);
  border-radius: var(--radius-lg);
  backdrop-filter: blur(22px) saturate(140%);
  -webkit-backdrop-filter: blur(22px) saturate(140%);
  padding: 40px 40px 12px;
  box-shadow:
    0 40px 80px -30px rgba(0,0,0,.6),
    inset 0 1px 0 rgba(255,255,255,.06);
  animation: card-rise .7s var(--ease) both;
}

@keyframes card-rise{
  from{ opacity:0; transform: translateY(18px) scale(.98); }
  to{   opacity:1; transform: translateY(0) scale(1); }
}

.header{
  margin-bottom: 30px;
  animation: fade-in .8s var(--ease) .1s both;
}

@keyframes fade-in{
  from{ opacity:0; transform: translateY(8px); }
  to{   opacity:1; transform: translateY(0); }
}

.badge{
  display:inline-flex;
  align-items:center;
  gap:8px;
  padding: 7px 14px 7px 10px;
  border-radius: 999px;
  background: var(--teal-soft);
  border: 1px solid rgba(20,216,160,.35);
  color: var(--teal);
  font-family: var(--font-display);
  font-size: 11px;
  font-weight: 600;
  letter-spacing: .06em;
  text-transform: uppercase;
  margin-bottom: 18px;
}

.dot{
  width:7px; height:7px;
  border-radius:50%;
  background: var(--teal);
  box-shadow: 0 0 0 0 rgba(20,216,160,.6);
  animation: pulse-dot 1.8s ease-in-out infinite;
}

@keyframes pulse-dot{
  0%{   box-shadow: 0 0 0 0 rgba(20,216,160,.55); }
  70%{  box-shadow: 0 0 0 8px rgba(20,216,160,0); }
  100%{ box-shadow: 0 0 0 0 rgba(20,216,160,0); }
}

h1{
  font-family: var(--font-display);
  font-weight: 700;
  font-size: clamp(28px, 4vw, 38px);
  line-height:1.1;
  letter-spacing: -.02em;
  margin: 0 0 10px;
  background: linear-gradient(100deg, var(--text-hi) 30%, var(--teal) 75%, var(--violet) 110%);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
}

.header p{
  margin:0;
  color: var(--text-mid);
  font-size: 14px;
  max-width: 480px;
  line-height:1.6;
}

/* ============================================================
   FILTER
   ============================================================ */
.filter-section{
  display:flex;
  align-items:center;
  justify-content:space-between;
  flex-wrap:wrap;
  gap:14px;
  padding: 14px 18px;
  margin-bottom: 22px;
  background: rgba(255,255,255,.02);
  border: 1px solid var(--border);
  border-radius: var(--radius-md);
  animation: fade-in .8s var(--ease) .18s both;
}

.filter-label{
  display:flex;
  align-items:center;
  gap:9px;
  font-size:12px;
  font-weight:600;
  color: var(--text-mid);
  letter-spacing:.01em;
  white-space:nowrap;
}

.filter-label svg{
  width:16px; height:16px;
  color: var(--teal);
}

.filter-wrap{
  display:flex;
  align-items:center;
  gap:10px;
  flex-wrap:wrap;
  position:relative;
}

.filter-wrap select{
  appearance:none;
  -webkit-appearance:none;
  background: rgba(255,255,255,.03);
  border: 1px solid var(--border);
  color: var(--text-hi);
  font-family: var(--font-body);
  font-size: 13px;
  padding: 10px 34px 10px 14px;
  border-radius: var(--radius-sm);
  cursor:pointer;
  transition: border-color .2s var(--ease), background .2s var(--ease);
  background-image: linear-gradient(45deg, transparent 50%, var(--text-mid) 50%), linear-gradient(135deg, var(--text-mid) 50%, transparent 50%);
  background-position: calc(100% - 16px) center, calc(100% - 11px) center;
  background-size: 5px 5px, 5px 5px;
  background-repeat: no-repeat;
}

.filter-wrap select:hover{
  border-color: var(--border-hi);
  background-color: rgba(255,255,255,.05);
}

.filter-wrap select:focus-visible{
  outline: none;
  border-color: var(--teal);
  box-shadow: 0 0 0 3px var(--teal-soft);
}

.filter-wrap svg.leading{
  display:none;
}

.filter-wrap button{
  display:flex;
  align-items:center;
  gap:8px;
  border:none;
  cursor:pointer;
  padding: 10px 20px;
  border-radius: var(--radius-sm);
  background: linear-gradient(135deg, var(--teal), #0fb98a);
  color:#04140f;
  font-family: var(--font-display);
  font-weight: 600;
  font-size: 13px;
  letter-spacing:.01em;
  transition: transform .18s var(--ease), box-shadow .18s var(--ease), filter .18s var(--ease);
  box-shadow: 0 8px 20px -8px rgba(20,216,160,.55);
}

.filter-wrap button:hover{
  transform: translateY(-1px);
  filter: brightness(1.06);
  box-shadow: 0 12px 26px -8px rgba(20,216,160,.7);
}

.filter-wrap button:active{
  transform: translateY(0);
}

/* ============================================================
   TABLE
   ============================================================ */
.table-container{
  overflow-x:auto;
  border: 1px solid var(--border);
  border-radius: var(--radius-md);
  animation: fade-in .8s var(--ease) .26s both;
}

table{
  width:100%;
  border-collapse:collapse;
  min-width: 760px;
}

thead th{
  text-align:left;
  font-family: var(--font-mono);
  font-size: 10px;
  font-weight: 500;
  letter-spacing: .08em;
  text-transform: uppercase;
  color: var(--text-low);
  padding: 15px 18px;
  background: rgba(255,255,255,.025);
  border-bottom: 1px solid var(--border);
  position: sticky;
  top:0;
}

tbody tr{
  position:relative;
  border-bottom: 1px solid rgba(255,255,255,.05);
  transition: background .2s var(--ease);
}

tbody tr:last-child{ border-bottom:none; }

tbody tr::before{
  content:"";
  position:absolute;
  left:0; top:0; bottom:0;
  width: 3px;
  background: linear-gradient(180deg, var(--teal), var(--violet));
  transform: scaleY(0);
  transform-origin: center;
  transition: transform .25s var(--ease);
}

tbody tr:hover{
  background: rgba(255,255,255,.03);
}

tbody tr:hover::before{
  transform: scaleY(1);
}

td{
  padding: 16px 18px;
  font-size: 13px;
  color: var(--text-mid);
  vertical-align: middle;
}

.product-name{
  color: var(--text-hi);
  font-weight: 500;
}

.price,
.quantity,
.amount{
  font-family: var(--font-mono);
  font-size: 12.5px;
  color: var(--text-hi);
}

.category{
  display:inline-flex;
  align-items:center;
  gap:7px;
  padding: 6px 12px 6px 8px;
  border-radius: 999px;
  background: var(--violet-soft);
  border: 1px solid rgba(139,107,255,.3);
  color: #c8bcff;
  font-size: 11.5px;
  font-weight: 500;
  transition: transform .18s var(--ease);
}

tbody tr:hover .category{
  transform: translateX(2px);
}

.category svg{
  width: 13px; height:13px;
  flex-shrink:0;
}

.status{
  display:inline-flex;
  align-items:center;
  gap:7px;
  padding: 6px 13px;
  border-radius: 999px;
  font-size: 11.5px;
  font-weight: 600;
}

.status::before{
  content:"";
  width:6px; height:6px;
  border-radius:50%;
}

.status-in-stock{
  background: var(--teal-soft);
  color: var(--teal);
}
.status-in-stock::before{
  background: var(--teal);
  animation: pulse-dot 1.8s ease-in-out infinite;
}

.status-out-of-stock{
  background: var(--ember-soft);
  color: var(--ember);
}
.status-out-of-stock::before{
  background: var(--ember);
}

/* ============================================================
   DIVIDER
   ============================================================ */
.divider{
  height:1px;
  margin: 22px 0 26px;
  background: linear-gradient(90deg, transparent, var(--border-hi) 50%, transparent);
  background-size: 200% 100%;
  animation: shimmer 6s linear infinite;
}

@keyframes shimmer{
  0%{   background-position: 200% 0; }
  100%{ background-position: -200% 0; }
}

/* ============================================================
   RESPONSIVE
   ============================================================ */
@media (max-width: 720px){
  body{ padding: 28px 14px; }
  .card{ padding: 26px 20px 8px; border-radius: var(--radius-md); }
  .filter-section{ flex-direction:column; align-items:stretch; }
  .filter-wrap{ justify-content:space-between; }
  .filter-wrap select{ flex:1; }
}

/* ============================================================
   ACCESSIBILITY
   ============================================================ */
@media (prefers-reduced-motion: reduce){
  *,
  *::before,
  *::after{
    animation-duration: .001ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: .001ms !important;
  }
}

:focus-visible{
  outline: 2px solid var(--teal);
  outline-offset: 2px;
}
</style>

</head>

<body>

        <!-- Animated background -->
        <div class="mesh-gradient"></div>
        <div class="particles" id="particles"></div>

        <div class="card">
            <div class="header">
                <div class="badge">
                    <span class="dot"></span>
                    <span>Gestion des produits</span>
                </div>
                <h1>Liste des produits</h1>
                <p>Consultez et gérez l'ensemble de votre catalogue produit.</p>
                <a href="http://localhost:8000/save">Ajouter Produit</a>
            </div>

            <!-- Filter -->
            <div class="filter-section">
                <div class="filter-label">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                    </svg>
                    Filtrer par catégorie
                </div>
                <form method="GET" action="http://localhost:8000/" class="filter-wrap">
                    <select name="categorie">
                        <option value="">Toutes les catégories</option>
                        <?php foreach($categories as $categorie): ?>
                        <option value="<?= $categorie->getId()?>"><?php echo $categorie->getNom()?></option>
                        <?php endforeach; ?>
                    </select>
                    <svg class="leading" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8" />
                        <line x1="21" y1="21" x2="16.65" y2="16.65" />
                    </svg>
                    <button type="submit">Filtrer</button>
                </form>
            </div>

            <!-- Table -->
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prix</th>
                            <th>Quantité stock</th>
                            <th>Montant stock</th>
                            <th>Catégorie</th>
                            <th>État</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($produits as $produit):?>
                        <tr>
                            <td class="product-name"><?= $produit->getLibelle()?></td>
                            <td class="price"><?= $produit->getPrix()?> €</td>
                            <td class="quantity"><?= $produit->getQuantiteStock()?></td>
                            <td class="amount"><?= $produit->getMontantStock()?> €</td>
                            <td>
                                <span class="category">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 2.69l5.66 5.66a8 8 0 11-11.31 0z"/>
                                    </svg>
                                    <?= $produit->getCategorie_id()->getNom()?>
                                </span>
                            </td>
                            <td><span class="status status-in-stock"><?= $produit->getStatut()?></span></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="divider"></div>
        </div>
</body>

</html>