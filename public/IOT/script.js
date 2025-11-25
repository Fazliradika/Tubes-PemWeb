// ===== NAVIGATION TOGGLE =====
const hamburger = document.querySelector('.hamburger');
const navLinks = document.querySelector('.nav-links');

hamburger.addEventListener('click', () => {
    hamburger.classList.toggle('active');
    navLinks.classList.toggle('active');
});

// Close menu when clicking a link
document.querySelectorAll('.nav-links a').forEach(link => {
    link.addEventListener('click', () => {
        hamburger.classList.remove('active');
        navLinks.classList.remove('active');
    });
});

// ===== SMOOTH SCROLL =====
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// ===== NAVBAR SCROLL EFFECT =====
const navbar = document.querySelector('.navbar');
let lastScroll = 0;

window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset;
    
    if (currentScroll > 100) {
        navbar.style.background = 'rgba(10, 22, 40, 0.98)';
        navbar.style.boxShadow = '0 5px 30px rgba(0, 0, 0, 0.3)';
    } else {
        navbar.style.background = 'rgba(10, 22, 40, 0.9)';
        navbar.style.boxShadow = 'none';
    }
    
    lastScroll = currentScroll;
});

// ===== SIMULATED SENSOR DATA =====
// Simulate real-time sensor data updates
class SensorSimulator {
    constructor() {
        this.phValue = 7.2;
        this.feedLevel = 75;
        this.temperature = 26;
        this.lastFeedTime = '10:30';
        this.feedSchedule = ['07:00', '12:00', '18:00'];
    }

    // Generate random pH value (6.5 - 8.0)
    updatePH() {
        const variation = (Math.random() - 0.5) * 0.3;
        this.phValue = Math.max(6.0, Math.min(8.5, this.phValue + variation));
        return this.phValue.toFixed(1);
    }

    // Simulate feed level decreasing over time
    updateFeedLevel() {
        if (Math.random() < 0.1) {
            this.feedLevel = Math.max(0, this.feedLevel - 1);
        }
        return this.feedLevel;
    }

    // Generate random temperature (24 - 28°C)
    updateTemperature() {
        const variation = (Math.random() - 0.5) * 0.5;
        this.temperature = Math.max(24, Math.min(28, this.temperature + variation));
        return Math.round(this.temperature);
    }

    // Get pH status based on value
    getPHStatus(value) {
        if (value >= 6.5 && value <= 7.5) {
            return { status: 'Normal', class: 'good' };
        } else if (value >= 6.0 && value <= 8.0) {
            return { status: 'Perhatian', class: 'warning' };
        } else {
            return { status: 'Bahaya!', class: 'danger' };
        }
    }

    // Get feed level status
    getFeedStatus(level) {
        if (level >= 50) {
            return { status: 'Cukup', class: 'good' };
        } else if (level >= 20) {
            return { status: 'Hampir Habis', class: 'warning' };
        } else {
            return { status: 'Segera Isi!', class: 'danger' };
        }
    }

    // Get temperature status
    getTempStatus(temp) {
        if (temp >= 25 && temp <= 27) {
            return { status: 'Optimal', class: 'good' };
        } else if (temp >= 24 && temp <= 28) {
            return { status: 'Normal', class: 'warning' };
        } else {
            return { status: 'Tidak Ideal', class: 'danger' };
        }
    }

    // Refill feed tank
    refillFeed() {
        this.feedLevel = 100;
    }
}

const sensor = new SensorSimulator();

// ===== UPDATE DASHBOARD =====
function updateDashboard() {
    // Update pH
    const phValue = sensor.updatePH();
    const phStatus = sensor.getPHStatus(parseFloat(phValue));
    document.getElementById('ph-value').textContent = phValue;
    const phStatusEl = document.getElementById('ph-status');
    phStatusEl.textContent = phStatus.status;
    phStatusEl.className = `status-badge ${phStatus.class}`;

    // Update Feed Level
    const feedLevel = sensor.updateFeedLevel();
    const feedStatus = sensor.getFeedStatus(feedLevel);
    document.getElementById('feed-fill').style.height = `${feedLevel}%`;
    document.getElementById('feed-percentage').textContent = `${feedLevel}%`;
    const feedStatusEl = document.getElementById('feed-status');
    feedStatusEl.textContent = feedStatus.status;
    feedStatusEl.className = `status-badge ${feedStatus.class}`;

    // Update Temperature
    const tempValue = sensor.updateTemperature();
    const tempStatus = sensor.getTempStatus(tempValue);
    document.getElementById('temp-value').textContent = tempValue;
    const tempStatusEl = document.getElementById('temp-status');
    tempStatusEl.textContent = tempStatus.status;
    tempStatusEl.className = `status-badge ${tempStatus.class}`;
}

// Update dashboard every 2 seconds
setInterval(updateDashboard, 2000);

// ===== FEEDING FUNCTION =====
let isFeeding = false;

function triggerFeeding() {
    if (isFeeding) return;

    const feedBtn = document.getElementById('feed-btn');
    const lastFeedTimeEl = document.getElementById('last-feed-time');

    isFeeding = true;
    feedBtn.classList.add('feeding');
    feedBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i><span>Memberi Pakan...</span>';

    // Simulate feeding animation
    setTimeout(() => {
        // Decrease feed level slightly after feeding
        sensor.feedLevel = Math.max(0, sensor.feedLevel - 5);
        
        // Update last feed time
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        lastFeedTimeEl.textContent = `${hours}:${minutes} WIB`;

        // Reset button
        feedBtn.classList.remove('feeding');
        feedBtn.innerHTML = '<i class="fas fa-hand-pointer"></i><span>Beri Pakan</span>';
        isFeeding = false;

        // Show success notification
        showNotification('Pakan berhasil diberikan! 🐟', 'success');
    }, 2000);
}

// ===== NOTIFICATION SYSTEM =====
function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.innerHTML = `
        <i class="fas ${type === 'success' ? 'fa-check-circle' : type === 'warning' ? 'fa-exclamation-triangle' : 'fa-info-circle'}"></i>
        <span>${message}</span>
    `;
    
    // Add styles
    Object.assign(notification.style, {
        position: 'fixed',
        top: '100px',
        right: '20px',
        background: type === 'success' ? 'rgba(0, 255, 136, 0.9)' : 
                   type === 'warning' ? 'rgba(255, 170, 0, 0.9)' : 
                   'rgba(0, 212, 255, 0.9)',
        color: '#0a1628',
        padding: '15px 25px',
        borderRadius: '10px',
        display: 'flex',
        alignItems: 'center',
        gap: '10px',
        fontWeight: '600',
        boxShadow: '0 10px 30px rgba(0, 0, 0, 0.3)',
        zIndex: '9999',
        animation: 'slideIn 0.3s ease',
        fontFamily: 'Poppins, sans-serif'
    });

    // Add animation keyframes
    if (!document.querySelector('#notification-styles')) {
        const style = document.createElement('style');
        style.id = 'notification-styles';
        style.textContent = `
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOut {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
        `;
        document.head.appendChild(style);
    }

    document.body.appendChild(notification);

    // Remove notification after 3 seconds
    setTimeout(() => {
        notification.style.animation = 'slideOut 0.3s ease';
        setTimeout(() => notification.remove(), 300);
    }, 3000);
}

// ===== SCROLL ANIMATIONS =====
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, observerOptions);

// Observe feature cards
document.querySelectorAll('.feature-card, .sensor-item, .workflow-item, .dashboard-card').forEach(el => {
    el.style.opacity = '0';
    el.style.transform = 'translateY(30px)';
    el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
    observer.observe(el);
});

// ===== SCHEDULE HIGHLIGHT =====
function updateScheduleHighlight() {
    const now = new Date();
    const currentHour = now.getHours();
    const scheduleItems = document.querySelectorAll('.schedule-item');
    
    scheduleItems.forEach(item => {
        const timeStr = item.querySelector('.schedule-time').textContent;
        const [hour] = timeStr.split(':').map(Number);
        
        item.classList.remove('active');
        const statusIcon = item.querySelector('.schedule-status i');
        
        if (currentHour >= hour && currentHour < hour + 6) {
            if (currentHour === hour || (currentHour > hour && currentHour < hour + 1)) {
                item.classList.add('active');
                statusIcon.className = 'fas fa-check-circle';
            }
        } else if (currentHour < hour) {
            statusIcon.className = 'fas fa-clock';
        } else {
            statusIcon.className = 'fas fa-check-circle';
        }
    });
}

// Update schedule every minute
updateScheduleHighlight();
setInterval(updateScheduleHighlight, 60000);

// ===== PARALLAX EFFECT FOR FISH =====
document.addEventListener('mousemove', (e) => {
    const fish = document.querySelectorAll('.fish');
    const x = e.clientX / window.innerWidth;
    const y = e.clientY / window.innerHeight;
    
    fish.forEach((f, index) => {
        const speed = (index + 1) * 10;
        f.style.transform = `translate(${x * speed}px, ${y * speed}px)`;
    });
});

// ===== AQUARIUM GLOW EFFECT ON HOVER =====
const aquariumGlass = document.querySelector('.aquarium-glass');
if (aquariumGlass) {
    aquariumGlass.addEventListener('mouseenter', () => {
        aquariumGlass.style.boxShadow = `
            0 0 60px rgba(0, 212, 255, 0.6),
            inset 0 0 100px rgba(0, 212, 255, 0.3)
        `;
    });
    
    aquariumGlass.addEventListener('mouseleave', () => {
        aquariumGlass.style.boxShadow = '';
    });
}

// ===== TYPING EFFECT FOR HERO =====
function typeWriter(element, text, speed = 50) {
    let i = 0;
    element.textContent = '';
    
    function type() {
        if (i < text.length) {
            element.textContent += text.charAt(i);
            i++;
            setTimeout(type, speed);
        }
    }
    
    type();
}

// ===== COUNTER ANIMATION =====
function animateCounter(element, target, duration = 2000) {
    const start = 0;
    const increment = target / (duration / 16);
    let current = start;
    
    function update() {
        current += increment;
        if (current < target) {
            element.textContent = Math.round(current);
            requestAnimationFrame(update);
        } else {
            element.textContent = target;
        }
    }
    
    update();
}

// ===== INITIALIZE =====
document.addEventListener('DOMContentLoaded', () => {
    // Initial dashboard update
    updateDashboard();
    
    // Add loading animation
    document.body.style.opacity = '0';
    document.body.style.transition = 'opacity 0.5s ease';
    
    setTimeout(() => {
        document.body.style.opacity = '1';
    }, 100);

    console.log('🐟 SmartFeeder Fish IoT - Ocean & Engines');
    console.log('📍 Telkom University Jakarta');
    console.log('📅 26 November 2025');
});

// ===== LOW FEED LEVEL ALERT =====
setInterval(() => {
    if (sensor.feedLevel < 20 && sensor.feedLevel > 0) {
        showNotification('⚠️ Level pakan rendah! Segera isi ulang.', 'warning');
    }
}, 30000); // Check every 30 seconds

// ===== EASTER EGG - KONAMI CODE =====
let konamiCode = ['ArrowUp', 'ArrowUp', 'ArrowDown', 'ArrowDown', 'ArrowLeft', 'ArrowRight', 'ArrowLeft', 'ArrowRight', 'b', 'a'];
let konamiIndex = 0;

document.addEventListener('keydown', (e) => {
    if (e.key === konamiCode[konamiIndex]) {
        konamiIndex++;
        if (konamiIndex === konamiCode.length) {
            // Trigger fun animation
            document.body.style.animation = 'rainbow 2s linear';
            showNotification('🎉 Kamu menemukan Easter Egg! 🐟🎮', 'success');
            konamiIndex = 0;
            
            // Add rainbow animation
            const style = document.createElement('style');
            style.textContent = `
                @keyframes rainbow {
                    0% { filter: hue-rotate(0deg); }
                    100% { filter: hue-rotate(360deg); }
                }
            `;
            document.head.appendChild(style);
            
            setTimeout(() => {
                document.body.style.animation = '';
            }, 2000);
        }
    } else {
        konamiIndex = 0;
    }
});
