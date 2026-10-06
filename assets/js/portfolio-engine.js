/**
 * Studio Dark Portfolio - Rama 1: Portfolio Engine (Case Studies & Masonry Interactions)
 */

document.addEventListener('DOMContentLoaded', () => {
    // Inicializar iconos
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }

    // Modal de Caso de Estudio
    const caseStudyModal = document.getElementById('caseStudyModal');
    if (!caseStudyModal) return;

    window.openCaseStudy = function(projectId) {
        // Disparar carga de datos del proyecto si están definidos globalmente
        if (window.caseStudyData && window.caseStudyData[projectId]) {
            const data = window.caseStudyData[projectId];
            
            const titleEl = document.getElementById('caseStudyTitle');
            const catEl = document.getElementById('caseStudyCategory');
            const clientEl = document.getElementById('caseStudyClient');
            const roleEl = document.getElementById('caseStudyRole');
            const dateEl = document.getElementById('caseStudyDate');
            const gearEl = document.getElementById('caseStudyGear');
            const descEl = document.getElementById('caseStudyDesc');
            const heroImg = document.getElementById('caseStudyHeroImg');
            const streamEl = document.getElementById('caseStudyStreamContainer');

            if (titleEl) titleEl.textContent = data.title;
            if (catEl) catEl.textContent = data.category;
            if (clientEl) clientEl.textContent = data.client;
            if (roleEl) roleEl.textContent = data.role;
            if (dateEl) dateEl.textContent = data.date;
            if (gearEl) gearEl.textContent = data.gear;
            if (descEl) descEl.innerHTML = data.desc;
            if (heroImg) heroImg.src = data.heroImg;

            // Renderizar flujo vertical de imágenes adicionales
            if (streamEl && data.stream) {
                streamEl.innerHTML = data.stream.map(imgUrl => `
                    <div class="rounded-2xl overflow-hidden glass-card">
                        <img src="${imgUrl}" alt="${data.title}" loading="lazy" class="w-full h-auto object-cover" />
                    </div>
                `).join('');
            }

            caseStudyModal.showModal();
            if (typeof lucide !== 'undefined') lucide.createIcons();
        }
    };

    window.closeCaseStudy = function() {
        caseStudyModal.close();
    };

    // Cerrar con Escape o click fuera
    caseStudyModal.addEventListener('click', (e) => {
        const dialogDimensions = caseStudyModal.getBoundingClientRect();
        if (
            e.clientX < dialogDimensions.left ||
            e.clientX > dialogDimensions.right ||
            e.clientY < dialogDimensions.top ||
            e.clientY > dialogDimensions.bottom
        ) {
            caseStudyModal.close();
        }
    });

    // =========================================================================
    // VIDEO HOVER PREVIEW EN TARJETAS MASONRY
    // =========================================================================
    const videoItems = document.querySelectorAll('.masonry-item');
    videoItems.forEach(item => {
        const video = item.querySelector('.masonry-video-preview');
        if (video) {
            video.muted = true;
            item.addEventListener('mouseenter', () => {
                const playPromise = video.play();
                if (playPromise !== undefined) {
                    playPromise.catch(() => {}); // Evitar warnings de autoplay
                }
            });
            item.addEventListener('mouseleave', () => {
                video.pause();
                video.currentTime = 0;
            });
        }
    });

    // =========================================================================
    // FILTROS DE CATEGORÍA DE PORTAFOLIO (PILLS INTERACTIVAS - INVERTIDO)
    // =========================================================================
    const filterPills = document.querySelectorAll('.portfolio-filter-pill, .portfolio-filter-btn');
    if (filterPills.length > 0) {
        filterPills.forEach(pill => {
            pill.addEventListener('click', () => {
                // Actualizar clases activas/inactivas con contraste alto (Look Invertido)
                filterPills.forEach(p => {
                    p.classList.remove('active', 'bg-white', 'text-black', 'border-white', 'font-semibold', 'shadow-md');
                    p.classList.add('bg-transparent', 'text-[#E0E0E0]', 'border-[#444]', 'font-medium');
                });
                pill.classList.add('active', 'bg-white', 'text-black', 'border-white', 'font-semibold');
                pill.classList.remove('bg-transparent', 'text-[#E0E0E0]', 'border-[#444]', 'font-medium');

                const filter = pill.getAttribute('data-filter') || 'all';
                const items = document.querySelectorAll('.masonry-item');
                items.forEach(item => {
                    const cat = item.getAttribute('data-category') || '';
                    if (filter === 'all' || cat.includes(filter)) {
                        item.style.display = '';
                        item.style.opacity = '1';
                    } else {
                        item.style.display = 'none';
                        item.style.opacity = '0';
                    }
                });
            });
        });
    }

    // =========================================================================
    // COMPARADOR INTERACTIVO ANTES / DESPUÉS (COLOR GRADING SLIDER)
    // Soporte 100% Vanilla JS para Mouse y Touch (Móvil / Escritorio)
    // =========================================================================
    function initBeforeAfterSliders() {
        const sliders = document.querySelectorAll('.before-after-slider, #colorGradingComparator');
        sliders.forEach(slider => {
            const clipLayer = slider.querySelector('.ba-clip-layer, .ba-resize');
            const handle = slider.querySelector('.ba-handle-divider, .ba-handle');
            if (!clipLayer || !handle) return;

            let isDragging = false;

            const updatePosition = (clientX) => {
                const rect = slider.getBoundingClientRect();
                let x = clientX - rect.left;
                let percent = (x / rect.width) * 100;
                if (percent < 0) percent = 0;
                if (percent > 100) percent = 100;

                // Actualizar clip-path de imagen superior (sin deformación)
                const remaining = 100 - percent;
                clipLayer.style.clipPath = `inset(0 ${remaining}% 0 0)`;
                clipLayer.style.webkitClipPath = `inset(0 ${remaining}% 0 0)`;

                // Fallback para ancho si se usa .ba-resize
                if (clipLayer.classList.contains('ba-resize')) {
                    clipLayer.style.width = percent + '%';
                }

                // Posicionar el handle y divisor central
                handle.style.left = percent + '%';
            };

            // Movimiento suave continuo al pasar el cursor (Hover-Follow tipo Artlist.io LUTs)
            slider.addEventListener('mousemove', (e) => {
                updatePosition(e.clientX);
            });
            slider.addEventListener('mouseenter', (e) => {
                updatePosition(e.clientX);
            });

            // Soporte para Click y Drag (Desktop)
            slider.addEventListener('mousedown', (e) => {
                isDragging = true;
                updatePosition(e.clientX);
            });
            window.addEventListener('mousemove', (e) => {
                if (isDragging) {
                    updatePosition(e.clientX);
                }
            });
            window.addEventListener('mouseup', () => {
                isDragging = false;
            });

            // Gestos Táctiles (Mobile / Touch Devices)
            slider.addEventListener('touchstart', (e) => {
                if (e.touches.length > 0) updatePosition(e.touches[0].clientX);
            }, { passive: true });
            slider.addEventListener('touchmove', (e) => {
                if (e.touches.length > 0) {
                    updatePosition(e.touches[0].clientX);
                }
            }, { passive: true });
            window.addEventListener('touchmove', (e) => {
                if (isDragging && e.touches.length > 0) {
                    updatePosition(e.touches[0].clientX);
                }
            }, { passive: true });
            window.addEventListener('touchend', () => {
                isDragging = false;
            });
            window.addEventListener('touchcancel', () => {
                isDragging = false;
            });
        });
    }

    initBeforeAfterSliders();

    window.setSliderPercent = function(targetPercent) {
        const slider = document.getElementById('colorGradingComparator');
        if (!slider) return;
        const clipLayer = slider.querySelector('.ba-clip-layer, .ba-resize');
        const handle = slider.querySelector('.ba-handle-divider, .ba-handle');
        if (!clipLayer || !handle) return;

        clipLayer.style.transition = 'clip-path 0.35s cubic-bezier(0.16, 1, 0.3, 1)';
        handle.style.transition = 'left 0.35s cubic-bezier(0.16, 1, 0.3, 1)';

        clipLayer.style.clipPath = `inset(0 calc(100% - ${targetPercent}%) 0 0)`;
        clipLayer.style.webkitClipPath = `inset(0 calc(100% - ${targetPercent}%) 0 0)`;
        handle.style.left = `${targetPercent}%`;

        setTimeout(() => {
            clipLayer.style.transition = '';
            handle.style.transition = '';
        }, 350);
    };
});
