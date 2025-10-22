export function initCustomCursor() {
    // Buat elemen cursor
    const cursor = document.createElement('div');
    cursor.classList.add('custom-cursor');
    document.body.appendChild(cursor);

    const cursorDot = document.createElement('div');
    cursorDot.classList.add('custom-cursor-dot');
    document.body.appendChild(cursorDot);

    let mouseX = 0, mouseY = 0;
    let cursorX = 0, cursorY = 0;

    // Smooth cursor movement
    function animateCursor() {
        cursorX += (mouseX - cursorX) * 0.2;
        cursorY += (mouseY - cursorY) * 0.2;
        
        cursor.style.left = cursorX + 'px';
        cursor.style.top = cursorY + 'px';
        
        cursorDot.style.left = mouseX + 'px';
        cursorDot.style.top = mouseY + 'px';
        
        requestAnimationFrame(animateCursor);
    }
    animateCursor();

    // Track posisi mouse
    document.addEventListener('mousemove', (e) => {
        mouseX = e.clientX;
        mouseY = e.clientY;
    });

    // Hover effect untuk elemen yang bisa diklik
    function addHoverEffects() {
        const hoverElements = document.querySelectorAll('a, button, input, textarea, select, [role="button"]');
        
        hoverElements.forEach(element => {
            element.addEventListener('mouseenter', () => {
                cursor.classList.add('hover');
            });
            
            element.addEventListener('mouseleave', () => {
                cursor.classList.remove('hover');
            });
        });
    }

    addHoverEffects();

    // Re-apply hover effects untuk konten dinamis
    const observer = new MutationObserver(() => {
        addHoverEffects();
    });

    observer.observe(document.body, {
        childList: true,
        subtree: true
    });

    // Hide cursor saat mouse keluar dari window
    document.addEventListener('mouseleave', () => {
        cursor.style.opacity = '0';
        cursorDot.style.opacity = '0';
    });

    document.addEventListener('mouseenter', () => {
        cursor.style.opacity = '1';
        cursorDot.style.opacity = '1';
    });
}