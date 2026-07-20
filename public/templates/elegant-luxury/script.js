document.addEventListener("DOMContentLoaded", () => {
    // 1. Cover and Music Logic
    const openBtn = document.getElementById('open-invitation');
    const coverSection = document.getElementById('cover');
    const mainContent = document.getElementById('main-content');
    const musicBtn = document.getElementById('music-btn');
    const bgMusic = document.getElementById('bg-music');
    const musicIcon = musicBtn.querySelector('i');
    
    let isPlaying = false;

    openBtn.addEventListener('click', () => {
        // Slide up the cover
        coverSection.style.transform = 'translateY(-100vh)';
        coverSection.style.opacity = '0';
        
        // Show main content and start scroll at top
        setTimeout(() => {
            coverSection.classList.add('hidden');
            mainContent.classList.remove('hidden');
            window.scrollTo(0, 0);
            
            // Show music button and play
            musicBtn.style.display = 'block';
            playMusic();
            
            // Trigger initial scroll animation check
            checkScrollAnimations();
        }, 800);
    });

    musicBtn.addEventListener('click', () => {
        if (isPlaying) {
            pauseMusic();
        } else {
            playMusic();
        }
    });

    function playMusic() {
        bgMusic.play();
        isPlaying = true;
        musicIcon.classList.add('fa-spin');
        musicIcon.classList.remove('fa-pause');
        musicIcon.classList.add('fa-compact-disc');
    }

    function pauseMusic() {
        bgMusic.pause();
        isPlaying = false;
        musicIcon.classList.remove('fa-spin');
        musicIcon.classList.remove('fa-compact-disc');
        musicIcon.classList.add('fa-pause');
    }

    // 2. Countdown Timer
    // Set to some date in the future
    const countDownDate = new Date("Dec 20, 2026 08:00:00").getTime();

    const timerInterval = setInterval(function() {
        const now = new Date().getTime();
        const distance = countDownDate - now;

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("days").innerText = days < 10 ? "0" + days : days;
        document.getElementById("hours").innerText = hours < 10 ? "0" + hours : hours;
        document.getElementById("minutes").innerText = minutes < 10 ? "0" + minutes : minutes;
        document.getElementById("seconds").innerText = seconds < 10 ? "0" + seconds : seconds;

        if (distance < 0) {
            clearInterval(timerInterval);
            document.getElementById("countdown").innerHTML = "<div class='time-box'><span>Hari H!</span></div>";
        }
    }, 1000);

    // 3. Scroll Fade-in Animation
    const fadeElements = document.querySelectorAll('.fade-in');

    function checkScrollAnimations() {
        const triggerBottom = window.innerHeight / 5 * 4.5;

        fadeElements.forEach(element => {
            const elementTop = element.getBoundingClientRect().top;
            if (elementTop < triggerBottom) {
                element.classList.add('visible');
            }
        });
    }

    window.addEventListener('scroll', checkScrollAnimations);

    // 4. Lightbox Gallery
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const closeLightbox = document.querySelector('.close-lightbox');
    const galleryImgs = document.querySelectorAll('.gallery-img');

    galleryImgs.forEach(img => {
        img.addEventListener('click', function() {
            lightbox.style.display = 'flex';
            lightboxImg.src = this.src;
        });
    });

    closeLightbox.addEventListener('click', () => {
        lightbox.style.display = 'none';
    });

    lightbox.addEventListener('click', (e) => {
        if (e.target !== lightboxImg) {
            lightbox.style.display = 'none';
        }
    });

    // 5. RSVP Form Submission
    const rsvpForm = document.getElementById('rsvp-form');
    rsvpForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Simulating submission
        const btn = this.querySelector('button');
        const originalText = btn.innerText;
        btn.innerText = 'Mengirim...';
        btn.disabled = true;

        setTimeout(() => {
            alert('Terima kasih! RSVP Anda telah terkirim.');
            this.reset();
            btn.innerText = originalText;
            btn.disabled = false;
        }, 1500);
    });

    // 6. Falling Petals Animation
    function createPetal() {
        const petalsContainer = document.getElementById('petals-container');
        const petal = document.createElement('div');
        petal.classList.add('petal');
        
        // Randomize properties
        const size = Math.random() * 10 + 5; // 5px to 15px
        petal.style.width = `${size}px`;
        petal.style.height = `${size}px`;
        petal.style.left = `${Math.random() * 100}vw`;
        petal.style.animationDuration = `${Math.random() * 3 + 4}s`; // 4s to 7s
        petal.style.animationDelay = `${Math.random() * 2}s`;
        
        petalsContainer.appendChild(petal);

        // Remove petal after animation finishes to prevent DOM overload
        setTimeout(() => {
            petal.remove();
        }, 7000);
    }

    // Create petals periodically
    setInterval(createPetal, 300);
});
