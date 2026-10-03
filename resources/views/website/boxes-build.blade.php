@extends('layouts.app')
@section('title', 'Build Your Box | Current Cravings')

@php
  $flavorNames = [
    'cookies' => [
      'Classic Choc Chip Cookie', 'Brown Butter Cookie', 'Double Choc Cookie',
      'White Choc Cookie', 'MnMs Cookie', 'Lotus Cookie', 'Oreo Cookie',
      'Salted Caramel Cookie', "S'mores Cookie",
    ],
    'brownies' => [
      'Kunafa Brownie', 'Classic Brownie', 'Biscoff Brownie', 'Oreo Brownie',
      'Double Choc Brownie', 'Salted Caramel Brownie', 'MnMs Brownie',
      'White Chocolate Brownie',
    ],
  ];
  $flavorColors = ['#f7a8b8', '#fcd47e', '#c89b7b', '#ffe6ef', '#fbb6c8', '#d4a373', '#9b8b83', '#f4d1a2', '#e6b0aa'];
  $productsByName = ($boxFlavorProducts ?? collect())->keyBy(
    fn ($product) => \Illuminate\Support\Str::lower(trim($product->name))
  );
  $flavorCatalog = [];

  foreach ($flavorNames as $category => $names) {
    foreach ($names as $index => $name) {
      $product = $productsByName->get(\Illuminate\Support\Str::lower($name));
      $fallbackImage = $category === 'cookies' ? asset('images/cookies.jpg') : asset('images/brownies.jpg');
      $flavorCatalog[$category][] = [
        'name' => $name,
        'color' => $flavorColors[$index % count($flavorColors)],
        'image' => $product?->image
          ? route('media.public', ['path' => $product->image], false)
          : $fallbackImage,
      ];
    }
  }
@endphp

@push('styles')
<style>
  :root {
    --accent: #f27d99;
    --accent-deep: #e8627d;
    --accent-soft: #fbb6c8;
    --cream: #fffbf5;
    --butter: #f7f3e9;
    --ink: #3a3526;
    --ink-mid: #6b6455;
    --green: #bef458;
  }
  body { background: var(--cream); color: var(--ink); }
  .accent-bg { background: var(--accent); }
  .accent-border { border-color: var(--accent); }
  .accent-text { color: var(--accent); }
  .builder-hero {
    background: linear-gradient(135deg, #fff0f4 0%, #fff8fb 40%, #f7f3e9 100%);
  }
  .builder-grid {
    display: grid;
    grid-template-columns: 1.1fr 0.9fr;
    gap: 32px;
  }
  @media (max-width: 980px) {
    .builder-grid { grid-template-columns: 1fr; }
  }
  .roulette-card,
  .panel-card {
    background: #fff;
    border: 1.5px solid rgba(242,125,153,0.18);
    border-radius: 24px;
    padding: 22px;
    position: relative;
    box-shadow: 0 18px 50px rgba(242,125,153,0.12);
  }
  .roulette-wrap {
    position: relative;
    display: grid;
    place-items: center;
    padding: 22px 0 8px;
  }
  .roulette-wheel {
    width: min(380px, 80vw);
    aspect-ratio: 1 / 1;
    border-radius: 50%;
    position: relative;
    border: 10px solid #fff;
    box-shadow: inset 0 0 0 2px rgba(242,125,153,0.2), 0 20px 40px rgba(242,125,153,0.18);
    transition: transform 2.8s cubic-bezier(.12,.78,.21,1);
    overflow: hidden;
  }
  .roulette-wheel::after {
    content: none;
  }
  .wheel-labels {
    position: absolute;
    inset: 0;
  }
  .wheel-label {
    position: absolute;
    left: 50%;
    top: 50%;
    transform-origin: center center;
    width: 52px;
    height: 52px;
    border-radius: 999px;
    border: 2.5px solid rgba(255,255,255,0.92);
    box-shadow: 0 8px 20px rgba(0,0,0,0.14);
    overflow: hidden;
    background: #fff;
  }
  .wheel-label img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }
  .wheel-overlay {
    position: absolute;
    inset: 0;
    display: grid;
    place-items: center;
    pointer-events: none;
    z-index: 5;
  }
  .wheel-overlay .spin-btn {
    pointer-events: auto;
  }
  .spin-btn {
    background: linear-gradient(135deg, var(--accent), var(--accent-deep));
    color: #fff;
    border: none;
    font-weight: 900;
    font-size: 14px;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    padding: 12px 18px;
    border-radius: 999px;
    cursor: pointer;
    box-shadow: 0 10px 24px rgba(242,125,153,0.35);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }
  .spin-btn:hover { transform: translateY(-2px) scale(1.03); box-shadow: 0 16px 36px rgba(242,125,153,0.4); }
  .spin-btn:disabled { opacity: 0.5; cursor: not-allowed; box-shadow: none; }
  .pointer {
    position: absolute;
    top: 10px;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 0;
    border-left: 14px solid transparent;
    border-right: 14px solid transparent;
    border-top: 24px solid var(--accent);
    filter: drop-shadow(0 6px 10px rgba(242,125,153,0.35));
    z-index: 4;
  }
  .status-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(242,125,153,0.12);
    color: var(--accent-deep);
    padding: 6px 10px;
    border-radius: 999px;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 0.08em;
    text-transform: uppercase;
  }
  .size-row {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
  }
  .size-btn {
    border: 1.5px solid rgba(242,125,153,0.3);
    background: #fff;
    color: var(--ink);
    padding: 8px 14px;
    border-radius: 999px;
    font-weight: 800;
    font-size: 12px;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    cursor: pointer;
  }
  .size-btn.active {
    background: var(--accent);
    color: #fff;
    border-color: var(--accent);
    box-shadow: 0 8px 20px rgba(242,125,153,0.3);
  }
  .slot-meter {
    display: flex;
    gap: 6px;
    flex-wrap: wrap;
    margin-top: 12px;
  }
  .slot-dot {
    width: 14px;
    height: 14px;
    border-radius: 50%;
    border: 1.5px solid rgba(242,125,153,0.3);
    background: #fff;
  }
  .slot-dot.filled { background: var(--accent); border-color: var(--accent); }
  .selection-list {
    margin-top: 16px;
    display: grid;
    gap: 10px;
  }
  .selection-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    padding: 10px 12px;
    border-radius: 14px;
    border: 1px solid rgba(242,125,153,0.12);
    background: #fff7fa;
  }
  .selection-name {
    font-weight: 700;
    font-size: 13px;
  }
  .selection-qty {
    font-weight: 800;
    font-size: 12px;
    color: var(--accent-deep);
  }
  .mini-btn {
    border: none;
    background: #fff;
    border: 1.5px solid rgba(242,125,153,0.2);
    color: var(--ink);
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    padding: 6px 10px;
    border-radius: 999px;
    cursor: pointer;
  }
  .mini-btn.locked { background: var(--accent); color: #fff; border-color: var(--accent); }
  .action-row {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-top: 16px;
  }
  .manual-card {
    margin-top: 18px;
    padding: 14px;
    border-radius: 18px;
    border: 1.5px dashed rgba(242,125,153,0.25);
    background: linear-gradient(135deg, rgba(255,240,244,0.9), rgba(255,255,255,0.95));
    box-shadow: 0 10px 26px rgba(242,125,153,0.12);
  }
  .manual-row {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-top: 10px;
  }
  .manual-select-wrap {
    position: relative;
    flex: 1 1 200px;
    min-width: 200px;
  }
  .manual-select-wrap::after {
    content: "expand_more";
    font-family: "Material Symbols Outlined";
    font-size: 20px;
    color: var(--accent-deep);
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
  }
  .manual-select {
    flex: 1 1 200px;
    min-width: 180px;
    border-radius: 999px;
    border: 1.5px solid rgba(242,125,153,0.3);
    padding: 10px 14px;
    background: #fff;
    color: var(--ink);
    font-weight: 700;
    font-size: 12px;
    letter-spacing: 0.02em;
    outline: none;
    appearance: none;
    -webkit-appearance: none;
    padding-right: 38px;
  }
  .manual-select:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(242,125,153,0.18);
  }
  .manual-add {
    border: none;
    background: linear-gradient(135deg, var(--accent), var(--accent-deep));
    color: #fff;
    padding: 10px 16px;
    border-radius: 999px;
    font-weight: 900;
    font-size: 12px;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    cursor: pointer;
    box-shadow: 0 10px 22px rgba(242,125,153,0.35);
  }
  .manual-add:hover { transform: translateY(-1px) scale(1.02); }
  .add-box-btn {
    margin-top: 18px;
    width: 100%;
    padding: 14px 16px;
    border-radius: 999px;
    border: none;
    font-weight: 900;
    font-size: 14px;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    background: linear-gradient(135deg, var(--accent), var(--accent-deep));
    color: #fff;
    cursor: pointer;
    box-shadow: 0 14px 30px rgba(242,125,153,0.35);
  }
  .add-box-btn[disabled] { opacity: 0.45; cursor: not-allowed; box-shadow: none; }
  .locked-row {
    margin-top: 12px;
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
  }
  .locked-chip {
    background: rgba(190,244,88,0.28);
    color: #446100;
    font-weight: 800;
    font-size: 11px;
    padding: 6px 10px;
    border-radius: 999px;
    letter-spacing: 0.08em;
    text-transform: uppercase;
  }
  .price-tag {
    font-weight: 900;
    font-size: 22px;
    color: var(--accent-deep);
  }
  .builder-note {
    font-size: 12px;
    color: var(--ink-mid);
  }
  .builder-hero-eyebrow { padding-top: 20px; }
  .btn-arrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    border-radius: 999px;
    background: linear-gradient(135deg, #f27d99, #e8627d);
    color: #fff;
    text-decoration: none;
    font-family: 'Epilogue', sans-serif;
    font-size: 13px;
    font-weight: 800;
    letter-spacing: 0.04em;
    box-shadow: 0 6px 18px rgba(242,125,153,0.35);
    transition: transform 0.25s ease, box-shadow 0.25s ease;
  }
  .btn-arrow:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 30px rgba(242,125,153,0.45);
  }
  .btn-arrow .btn-arrow-icon {
    width: 26px;
    height: 26px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: rgba(255,255,255,0.24);
    transition: background 0.2s ease, transform 0.2s ease;
  }
  .btn-arrow .btn-arrow-icon .material-symbols-outlined {
    font-size: 16px !important;
    color: #fff;
    line-height: 1;
  }
  .btn-arrow:hover .btn-arrow-icon {
    background: rgba(255,255,255,0.36);
    transform: translateX(-1px);
  }
</style>
@endpush

@section('content')
<div>
  <section class="builder-hero px-8 py-24 md:py-28 lg:py-32 page-hero-under-header">
    <div class="max-w-6xl mx-auto text-center">
      <div class="builder-hero-eyebrow">
        <span class="status-pill">Spin To Pick Your Flavours</span>
      </div>
      <h1 class="font-headline text-5xl md:text-7xl font-black tracking-tight mt-4">
        Build Your <span class="gradient-headline">Box</span>
      </h1>
      <p class="text-[#66645e] text-lg md:text-xl max-w-2xl mx-auto mt-4">
        Spin the roulette, lock your favorites, and fill your box with the flavours you love.
      </p>
      <div class="mt-8 flex flex-col sm:flex-row justify-center gap-4">
        <a class="btn-arrow" href="{{ route('menu.show', 'boxes') }}">
          <span>Back to Boxes</span>
          <span class="btn-arrow-icon"><span class="material-symbols-outlined" style="font-size:16px;">arrow_back</span></span>
        </a>
        <a class="accent-border border-2 accent-text px-8 py-3 rounded-full font-bold hover:bg-[#f27d99] hover:text-white transition-colors" href="{{ route('menu.index') }}">Full Menu</a>
      </div>
    </div>
  </section>

  <section class="px-8 py-16">
    <div class="max-w-6xl mx-auto builder-grid">
      <div class="roulette-card">
        <div class="roulette-wrap">
          <div class="pointer"></div>
          <div class="roulette-wheel" id="rouletteWheel">
            <div class="wheel-labels" id="wheelLabels"></div>
          </div>
          <div class="wheel-overlay">
            <button class="spin-btn" id="spinBtn">Spin</button>
          </div>
        </div>
        <div class="builder-note text-center mt-4" id="spinStatus">Ready to spin. Slots left: <strong id="slotsLeftText">6</strong></div>
        <div class="locked-row" id="lockedRow"></div>
      </div>

      <div class="panel-card">
        <div class="flex items-center justify-between">
          <div>
            <div class="text-xs uppercase tracking-[0.25em] text-primary font-bold">Box Type</div>
            <div class="builder-note mt-1">Choose cookies or brownies for this box.</div>
          </div>
        </div>
        <div class="size-row mt-4 mb-6" id="categoryRow">
          <button class="size-btn active" data-category="cookies">Cookies</button>
          <button class="size-btn" data-category="brownies">Brownies</button>
        </div>

        <div class="flex items-center justify-between">
          <div>
            <div class="text-xs uppercase tracking-[0.25em] text-primary font-bold">Box Size</div>
            <div class="builder-note mt-1">Pick your box size first.</div>
          </div>
          <div class="price-tag" id="boxPrice">£24.00</div>
        </div>
        <div class="size-row mt-4" id="sizeRow">
          <button class="size-btn active" data-size="6">6 Pack</button>
          <button class="size-btn" data-size="4">4 Pack</button>
        </div>
        <div class="slot-meter" id="slotMeter"></div>

        <div class="mt-6">
          <div class="text-xs uppercase tracking-[0.25em] text-primary font-bold">Selected Flavours</div>
          <div class="selection-list" id="selectionList"></div>
        </div>

        <div class="manual-card">
          <div class="text-xs uppercase tracking-[0.25em] text-primary font-bold">Pick Your Own</div>
          <div class="builder-note mt-1">Pick a flavour yourself and add it to the box.</div>
          <div class="manual-row">
            <div class="manual-select-wrap">
              <select id="manualFlavor" class="manual-select">
                <option value="">Select flavour</option>
              </select>
            </div>
            <button class="manual-add" id="manualAddBtn">Add Flavour</button>
          </div>
        </div>

        <div class="action-row">
          <button class="mini-btn" id="undoBtn">Undo Spin</button>
          <button class="mini-btn" id="clearBtn">Clear All</button>
        </div>

        <button class="add-box-btn" id="addBoxBtn"
                data-add-to-cart="1"
                data-open-cart="1"
                data-category="boxes"
                data-image="{{ asset('images/3.jpg') }}"
                disabled>Add Box to Cart</button>
        <div class="builder-note mt-3">Finish all slots to enable checkout.</div>
      </div>
    </div>
  </section>
</div>
@endsection

@push('scripts')
<script>
(() => {
  const flavorCatalog = @json($flavorCatalog);
  const params = new URLSearchParams(window.location.search);
  let activeCategory = params.get('type') === 'brownies' ? 'brownies' : 'cookies';
  let flavors = flavorCatalog[activeCategory];

  const sizePrices = { 4: 18, 6: 24 };
  const wheel = document.getElementById('rouletteWheel');
  const labels = document.getElementById('wheelLabels');
  const spinBtn = document.getElementById('spinBtn');
  const sizeRow = document.getElementById('sizeRow');
  const categoryRow = document.getElementById('categoryRow');
  const slotMeter = document.getElementById('slotMeter');
  const selectionList = document.getElementById('selectionList');
  const addBoxBtn = document.getElementById('addBoxBtn');
  const boxPrice = document.getElementById('boxPrice');
  const slotsLeftText = document.getElementById('slotsLeftText');
  const spinStatus = document.getElementById('spinStatus');
  const lockedRow = document.getElementById('lockedRow');
  const undoBtn = document.getElementById('undoBtn');
  const clearBtn = document.getElementById('clearBtn');
  const manualFlavor = document.getElementById('manualFlavor');
  const manualAddBtn = document.getElementById('manualAddBtn');

  let size = 6;
  let totalRotation = 0;
  let spinning = false;
  const selected = new Map();
  const locked = new Set();
  const history = [];

  function buildWheel() {
    const angle = 360 / flavors.length;
    const gradient = flavors
      .map((f, i) => `${f.color} ${i * angle}deg ${(i + 1) * angle}deg`)
      .join(', ');
    wheel.style.background = `conic-gradient(${gradient})`;

    labels.innerHTML = '';
    const thumbSize = 52;
    const radius = Math.max(110, Math.floor(wheel.clientWidth / 2) - (thumbSize + 8));
    flavors.forEach((flavor, i) => {
      const label = document.createElement('div');
      label.className = 'wheel-label';
      const rotate = i * angle + angle / 2;
      const rad = (rotate - 90) * (Math.PI / 180);
      const x = Math.cos(rad) * radius;
      const y = Math.sin(rad) * radius;
      label.style.transform = `translate(${x}px, ${y}px) translate(-50%, -50%)`;
      const img = document.createElement('img');
      img.src = flavor.image;
      img.alt = flavor.name;
      label.appendChild(img);
      labels.appendChild(label);
    });
  }

  function totalSelected() {
    let total = 0;
    selected.forEach(qty => total += qty);
    return total;
  }

  function updateSlots() {
    const used = totalSelected();
    const remaining = Math.max(0, size - used);
    slotMeter.innerHTML = '';
    for (let i = 0; i < size; i++) {
      const dot = document.createElement('div');
      dot.className = 'slot-dot' + (i < used ? ' filled' : '');
      slotMeter.appendChild(dot);
    }
    slotsLeftText.textContent = String(remaining);
    spinStatus.innerHTML = remaining > 0
      ? `Ready to spin. Slots left: <strong>${remaining}</strong>`
      : `Box filled! You can add it to cart.`;
    addBoxBtn.disabled = remaining !== 0;
    spinBtn.disabled = remaining === 0 || spinning;
  }

  function updateSelections() {
    selectionList.innerHTML = '';
    const entries = Array.from(selected.entries());
    if (!entries.length) {
      selectionList.innerHTML = '<div class="builder-note">No flavours yet. Spin to start.</div>';
    } else {
      entries.forEach(([name, qty]) => {
        const row = document.createElement('div');
        row.className = 'selection-item';
        const left = document.createElement('div');
        left.innerHTML = `<div class="selection-name">${name}</div><div class="selection-qty">x${qty}</div>`;
        const right = document.createElement('div');
        const lockBtn = document.createElement('button');
        lockBtn.className = 'mini-btn' + (locked.has(name) ? ' locked' : '');
        lockBtn.textContent = locked.has(name) ? 'Locked' : 'Lock';
        lockBtn.addEventListener('click', () => toggleLock(name));
        const removeBtn = document.createElement('button');
        removeBtn.className = 'mini-btn';
        removeBtn.textContent = 'Remove';
        removeBtn.addEventListener('click', () => removeOne(name));
        right.appendChild(lockBtn);
        right.appendChild(removeBtn);
        row.appendChild(left);
        row.appendChild(right);
        selectionList.appendChild(row);
      });
    }

    lockedRow.innerHTML = '';
    locked.forEach(name => {
      const chip = document.createElement('div');
      chip.className = 'locked-chip';
      chip.textContent = name;
      lockedRow.appendChild(chip);
    });
  }

  function updateAddButton() {
    const summary = Array.from(selected.entries())
      .map(([name, qty]) => `${name} x${qty}`)
      .join(', ');
    const shortSummary = summary.length > 120 ? summary.slice(0, 117) + '...' : summary;
    addBoxBtn.dataset.name = shortSummary
      ? `Custom ${activeCategory === 'brownies' ? 'Brownies' : 'Cookies'} Box (${size}) — ${shortSummary}`
      : `Custom ${activeCategory === 'brownies' ? 'Brownies' : 'Cookies'} Box (${size})`;
    addBoxBtn.dataset.price = (sizePrices[size] || 0).toFixed(2);
  }

  function buildManualList() {
    if (!manualFlavor) return;
    manualFlavor.innerHTML = '<option value="">Select flavour</option>';
    flavors.forEach(flavor => {
      const opt = document.createElement('option');
      opt.value = flavor.name;
      opt.textContent = flavor.name;
      manualFlavor.appendChild(opt);
    });
  }

  function addFlavor(name) {
    if (totalSelected() >= size) return;
    selected.set(name, (selected.get(name) || 0) + 1);
    history.push(name);
    updateSelections();
    updateSlots();
    updateAddButton();
  }

  function removeOne(name) {
    if (!selected.has(name)) return;
    const next = selected.get(name) - 1;
    if (next <= 0) {
      selected.delete(name);
      locked.delete(name);
    } else {
      selected.set(name, next);
    }
    updateSelections();
    updateSlots();
    updateAddButton();
  }

  function toggleLock(name) {
    if (!selected.has(name)) return;
    if (locked.has(name)) {
      locked.delete(name);
    } else {
      locked.add(name);
    }
    updateSelections();
  }

  function spin() {
    if (spinning || totalSelected() >= size) return;
    spinning = true;
    const angle = 360 / flavors.length;
    const idx = Math.floor(Math.random() * flavors.length);
    const target = 360 - (idx * angle + angle / 2);
    const normalized = ((totalRotation % 360) + 360) % 360;
    const extraTurns = 4 + Math.floor(Math.random() * 2);
    const delta = extraTurns * 360 + (target - normalized);
    totalRotation += delta;
    wheel.style.transform = `rotate(${totalRotation}deg)`;

    spinBtn.disabled = true;
    setTimeout(() => {
      spinning = false;
      addFlavor(flavors[idx].name);
      spinBtn.disabled = totalSelected() >= size;
    }, 2900);
  }

  function resetBox() {
    selected.clear();
    locked.clear();
    history.length = 0;
    updateSelections();
    updateSlots();
    updateAddButton();
  }

  function undoSpin() {
    const last = history.pop();
    if (!last) return;
    removeOne(last);
  }

  function setSize(next) {
    if (next === size) return;
    size = next;
    sizeRow.querySelectorAll('.size-btn').forEach(btn => {
      btn.classList.toggle('active', Number(btn.dataset.size) === size);
    });
    boxPrice.textContent = '£' + (sizePrices[size] || 0).toFixed(2);
    resetBox();
  }

  function setCategory(next) {
    if (!flavorCatalog[next] || spinning) return;
    activeCategory = next;
    flavors = flavorCatalog[activeCategory];
    categoryRow.querySelectorAll('.size-btn').forEach(btn => {
      btn.classList.toggle('active', btn.dataset.category === activeCategory);
    });
    totalRotation = 0;
    wheel.style.transform = 'rotate(0deg)';
    resetBox();
    buildWheel();
    buildManualList();
  }

  spinBtn.addEventListener('click', spin);
  undoBtn.addEventListener('click', undoSpin);
  clearBtn.addEventListener('click', resetBox);
  if (manualAddBtn) {
    manualAddBtn.addEventListener('click', () => {
      const name = manualFlavor ? manualFlavor.value : '';
      if (!name) return;
      addFlavor(name);
    });
  }
  sizeRow.addEventListener('click', (e) => {
    const btn = e.target.closest('.size-btn');
    if (!btn) return;
    setSize(Number(btn.dataset.size));
  });
  categoryRow.addEventListener('click', (e) => {
    const btn = e.target.closest('.size-btn');
    if (!btn) return;
    setCategory(btn.dataset.category);
  });

  const sizeParam = Number(params.get('size'));
  if ([4, 6].includes(sizeParam)) setSize(sizeParam);

  setCategory(activeCategory);
  window.addEventListener('resize', buildWheel);
})();
</script>
@endpush

