<?php
use Cisse\CategorieProduitPoo\Core\Debug as DD;
$categories = $categorieRepository ?? [];
//DD::dd($categories);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un produit — Nova Store</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=JetBrains+Mono:wght@400;500&display=swap');

/* ============================================================
   NOVA STORE — tokens (identiques à la liste des produits)
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

/* ============================================================
   Fond animé (identique à la liste des produits)
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
  max-width: 720px;
  background: var(--glass);
  border: 1px solid var(--border);
  border-radius: var(--radius-lg);
  backdrop-filter: blur(22px) saturate(140%);
  -webkit-backdrop-filter: blur(22px) saturate(140%);
  padding: 40px 40px 36px;
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
  background: var(--violet-soft);
  border: 1px solid rgba(139,107,255,.35);
  color: #c8bcff;
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
  background: var(--violet);
  box-shadow: 0 0 0 0 rgba(139,107,255,.6);
  animation: pulse-dot 1.8s ease-in-out infinite;
}

@keyframes pulse-dot{
  0%{   box-shadow: 0 0 0 0 rgba(139,107,255,.55); }
  70%{  box-shadow: 0 0 0 8px rgba(139,107,255,0); }
  100%{ box-shadow: 0 0 0 0 rgba(139,107,255,0); }
}

h1{
  font-family: var(--font-display);
  font-weight: 700;
  font-size: clamp(26px, 4vw, 34px);
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
   FORM
   ============================================================ */
form.product-form{
  display:flex;
  flex-direction:column;
  gap: 20px;
  animation: fade-in .8s var(--ease) .18s both;
}

.field-row{
  display:grid;
  grid-template-columns: 1fr 1fr;
  gap: 18px;
}

.field{
  display:flex;
  flex-direction:column;
  gap:8px;
}

.field label{
  display:flex;
  align-items:center;
  gap:8px;
  font-family: var(--font-mono);
  font-size: 10.5px;
  font-weight: 500;
  letter-spacing: .07em;
  text-transform: uppercase;
  color: var(--text-low);
}

.field label svg{
  width:13px; height:13px;
  color: var(--teal);
  flex-shrink:0;
}

.field-hint{
  font-size: 11.5px;
  color: var(--text-low);
  line-height:1.5;
  margin-top:-2px;
}

.field input,
.field select,
.field textarea{
  appearance:none;
  -webkit-appearance:none;
  width:100%;
  background: rgba(255,255,255,.03);
  border: 1px solid var(--border);
  color: var(--text-hi);
  font-family: var(--font-body);
  font-size: 14px;
  padding: 12px 14px;
  border-radius: var(--radius-sm);
  transition: border-color .2s var(--ease), background .2s var(--ease), box-shadow .2s var(--ease);
}

.field input::placeholder,
.field textarea::placeholder{
  color: var(--text-low);
}

.field select{
  cursor:pointer;
  background-image: linear-gradient(45deg, transparent 50%, var(--text-mid) 50%), linear-gradient(135deg, var(--text-mid) 50%, transparent 50%);
  background-position: calc(100% - 16px) center, calc(100% - 11px) center;
  background-size: 5px 5px, 5px 5px;
  background-repeat: no-repeat;
  padding-right: 34px;
}

.field input:hover,
.field select:hover,
.field textarea:hover{
  border-color: var(--border-hi);
  background-color: rgba(255,255,255,.05);
}

.field input:focus-visible,
.field select:focus-visible,
.field textarea:focus-visible{
  outline: none;
  border-color: var(--teal);
  box-shadow: 0 0 0 3px var(--teal-soft);
}

.field textarea{
  resize: vertical;
  min-height: 78px;
  font-family: var(--font-body);
}

/* Champ référence interne — mis en avant comme donnée technique */
.internal-field{
  border: 1px dashed rgba(255,184,77,.35);
  background: var(--amber-soft);
  border-radius: var(--radius-md);
  padding: 16px 18px;
  display:flex;
  flex-direction:column;
  gap:10px;
}

.internal-field .field-title{
  display:flex;
  align-items:center;
  gap:8px;
  font-family: var(--font-display);
  font-weight: 600;
  font-size: 12.5px;
  color: var(--amber);
  letter-spacing:.02em;
}

.internal-field .field-title svg{
  width:15px; height:15px;
}

.internal-field .field-title .tag{
  font-family: var(--font-mono);
  font-size: 9.5px;
  font-weight: 500;
  letter-spacing:.06em;
  text-transform:uppercase;
  color: var(--void);
  background: var(--amber);
  padding: 3px 8px;
  border-radius: 999px;
}

.internal-field .field-row{
  margin-top:2px;
}

.internal-field input[readonly]{
  font-family: var(--font-mono);
  color: var(--text-mid);
  background: rgba(255,255,255,.02);
  cursor: not-allowed;
}

/* ============================================================
   STATUS TOGGLE (radio pills — reprend le style .status)
   ============================================================ */
.status-toggle{
  display:flex;
  gap:10px;
  flex-wrap:wrap;
}

.status-toggle input{
  position:absolute;
  opacity:0;
  width:0; height:0;
}

.status-toggle label{
  display:inline-flex;
  align-items:center;
  gap:7px;
  padding: 9px 16px;
  border-radius: 999px;
  font-size: 12.5px;
  font-weight: 600;
  text-transform:none;
  letter-spacing:0;
  cursor:pointer;
  border: 1px solid var(--border);
  background: rgba(255,255,255,.03);
  color: var(--text-mid);
  transition: all .18s var(--ease);
}

.status-toggle label::before{
  content:"";
  width:6px; height:6px;
  border-radius:50%;
  background: var(--text-low);
  transition: background .18s var(--ease);
}

.status-toggle input:checked + label{
  border-color: rgba(20,216,160,.4);
  background: var(--teal-soft);
  color: var(--teal);
}

.status-toggle input:checked + label::before{
  background: var(--teal);
}

.status-toggle input#etat-rupture:checked + label{
  border-color: rgba(255,107,91,.4);
  background: var(--ember-soft);
  color: var(--ember);
}

.status-toggle input#etat-rupture:checked + label::before{
  background: var(--ember);
}

/* ============================================================
   DIVIDER + ACTIONS
   ============================================================ */
.divider{
  height:1px;
  margin: 6px 0 4px;
  background: linear-gradient(90deg, transparent, var(--border-hi) 50%, transparent);
  background-size: 200% 100%;
  animation: shimmer 6s linear infinite;
}

@keyframes shimmer{
  0%{   background-position: 200% 0; }
  100%{ background-position: -200% 0; }
}

.actions{
  display:flex;
  align-items:center;
  justify-content:flex-end;
  gap:12px;
  margin-top: 18px;
}

.btn{
  display:inline-flex;
  align-items:center;
  gap:8px;
  border:none;
  cursor:pointer;
  padding: 12px 22px;
  border-radius: var(--radius-sm);
  font-family: var(--font-display);
  font-weight: 600;
  font-size: 13.5px;
  letter-spacing:.01em;
  transition: transform .18s var(--ease), box-shadow .18s var(--ease), filter .18s var(--ease), background .18s var(--ease), color .18s var(--ease);
}

.btn-ghost{
  background: transparent;
  border: 1px solid var(--border);
  color: var(--text-mid);
}

.btn-ghost:hover{
  border-color: var(--border-hi);
  color: var(--text-hi);
  background: rgba(255,255,255,.03);
}

.btn-primary{
  background: linear-gradient(135deg, var(--teal), #0fb98a);
  color:#04140f;
  box-shadow: 0 8px 20px -8px rgba(20,216,160,.55);
}

.btn-primary:hover{
  transform: translateY(-1px);
  filter: brightness(1.06);
  box-shadow: 0 12px 26px -8px rgba(20,216,160,.7);
}

.btn-primary:active{
  transform: translateY(0);
}

.btn svg{
  width:15px; height:15px;
}

/* ============================================================
   RESPONSIVE
   ============================================================ */
@media (max-width: 640px){
  body{ padding: 28px 14px; }
  .card{ padding: 26px 20px 24px; border-radius: var(--radius-md); }
  .field-row{ grid-template-columns: 1fr; gap: 20px; }
  .actions{ flex-direction:column-reverse; align-items:stretch; }
  .actions .btn{ justify-content:center; }
}

/* ============================================================
   ACCESSIBILITY
   ============================================================ */
@media (prefers-reduced-motion: reduce){
  *, *::before, *::after{
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

    <div class="mesh-gradient"></div>
    <div class="particles"></div>

    <div class="card">
        <div class="header">
            <div class="badge">
                <span class="dot"></span>
                <span>Gestion des produits</span>
            </div>
            <h1>Ajouter un produit</h1>
            <p>Renseignez les informations du produit. Les champs marqués « interne » ne sont visibles que par l'équipe et ne sont jamais affichés côté catalogue public.</p>
        </div>

        <form class="product-form" method="POST" action="http://localhost:8000/save">

            <div class="field">
                <label for="nom">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 01-2.83 0L2 12V2h10l8.59 8.59a2 2 0 010 2.82z" />
                        <line x1="7" y1="7" x2="7.01" y2="7" />
                    </svg>
                    Nom du produit
                </label>
                <input type="text" id="nom" name="libelle" placeholder="ex. Savon artisanal au lait de chèvre" required>
            </div>

            <div class="field-row">
                <div class="field">
                    <label for="prix">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="1" x2="12" y2="23" />
                            <path d="M17 5H9.5a3.5 3.5 0 000 7h5a3.5 3.5 0 010 7H6" />
                        </svg>
                        Prix unitaire
                    </label>
                    <input type="number" id="prix" name="prix" placeholder="0,00" step="0.01" min="0" required>
                </div>
                <div class="field">
                    <label for="quantite">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.59 13.41l-7.17 7.17a2 2 0 01-2.83 0L2 12V2h10l8.59 8.59a2 2 0 010 2.82z" />
                        </svg>
                        Quantité en stock
                    </label>
                    <input type="number" id="quantite" name="quantiteStock" placeholder="0" min="0" required>
                </div>
            </div>

            <div class="field">
                <label for="categorie">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
                    </svg>
                    Catégorie
                </label>
                <select name="categorie_id" required>
                    <option value="" disabled selected>Sélectionner une catégorie</option>
                        <?php foreach($categories as $categorie): ?>
                    <option value="<?= $categorie->getId()?>"><?php echo $categorie->getNom()?></option>
                        <?php endforeach; ?>
                </select>
            </div>

            <div class="field">
                <label>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M8 12l3 3 6-6" />
                    </svg>
                    État du stock
                </label>
                <div class="status-toggle">
                    <input type="radio" id="etat-stock" name="etat" value="en_stock" checked>
                    <label for="etat-stock">En stock</label>
                    <input type="radio" id="etat-rupture" name="etat" value="rupture">
                    <label for="etat-rupture">En rupture</label>
                </div>
            </div>

            <div class="field">
                <label for="description">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                        <polyline points="14 2 14 8 20 8" />
                        <line x1="16" y1="13" x2="8" y2="13" />
                        <line x1="16" y1="17" x2="8" y2="17" />
                    </svg>
                    Description <span style="color:var(--text-low); text-transform:none; font-weight:400; letter-spacing:0;">(optionnel)</span>
                </label>
                <textarea id="description" name="description" placeholder="Détails visibles sur la fiche produit du catalogue…"></textarea>
            </div>

            <!-- Bloc interne : référence & note réservées à l'équipe -->
            <div class="internal-field">
                <div class="field-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2" />
                        <path d="M7 11V7a5 5 0 0110 0v4" />
                    </svg>
                    Informations internes
                    <span class="tag">Usage équipe</span>
                </div>
                <div class="field-row">
                    <div class="field">
                        <label for="reference-interne">Référence interne (SKU)</label>
                        <input type="text" id="reference-interne" name="reference_interne" value="auto-générée à l'enregistrement" readonly>
                    </div>
                    <div class="field">
                        <label for="fournisseur">Fournisseur</label>
                        <input type="text" id="fournisseur" name="fournisseur" placeholder="ex. Atelier Bio Sud">
                    </div>
                </div>
                <div class="field">
                    <label for="note-interne">Note interne</label>
                    <textarea id="note-interne" name="note_interne" placeholder="Remarques logistiques, contact fournisseur, seuil de réappro…" style="min-height:56px;"></textarea>
                    <span class="field-hint">Non visible sur le catalogue public — réservé à l'équipe de gestion des stocks.</span>
                </div>
            </div>

            <div class="divider"></div>

            <div class="actions">
                <button type="reset" class="btn btn-ghost">Annuler</button>
                <button type="submit" class="btn btn-primary">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    Ajouter le produit
                </button>
            </div>

        </form>
    </div>

</body>

</html>