/**
 * Utility Functions for Webeetools
 */

// DOM Utilities
export const DOM = {
    /**
     * Get element by selector
     * @param {string} selector - CSS selector
     * @returns {Element|null}
     */
    get(selector) {
        return document.querySelector(selector);
    },

    /**
     * Get all elements by selector
     * @param {string} selector - CSS selector
     * @returns {NodeList}
     */
    getAll(selector) {
        return document.querySelectorAll(selector);
    },

    /**
     * Create element with attributes
     * @param {string} tag - HTML tag
     * @param {Object} attributes - Element attributes
     * @param {string} content - Element content
     * @returns {Element}
     */
    create(tag, attributes = {}, content = '') {
        const element = document.createElement(tag);
        
        Object.entries(attributes).forEach(([key, value]) => {
            if (key === 'className') {
                element.className = value;
            } else if (key === 'dataset') {
                Object.entries(value).forEach(([dataKey, dataValue]) => {
                    element.dataset[dataKey] = dataValue;
                });
            } else {
                element.setAttribute(key, value);
            }
        });

        if (content) {
            element.innerHTML = content;
        }

        return element;
    },

    /**
     * Add class to element(s)
     * @param {Element|NodeList} elements 
     * @param {string} className 
     */
    addClass(elements, className) {
        const elemArray = elements instanceof NodeList ? Array.from(elements) : [elements];
        elemArray.forEach(el => el?.classList.add(className));
    },

    /**
     * Remove class from element(s)
     * @param {Element|NodeList} elements 
     * @param {string} className 
     */
    removeClass(elements, className) {
        const elemArray = elements instanceof NodeList ? Array.from(elements) : [elements];
        elemArray.forEach(el => el?.classList.remove(className));
    },

    /**
     * Toggle class on element(s)
     * @param {Element|NodeList} elements 
     * @param {string} className 
     */
    toggleClass(elements, className) {
        const elemArray = elements instanceof NodeList ? Array.from(elements) : [elements];
        elemArray.forEach(el => el?.classList.toggle(className));
    }
};

// Animation Utilities
export const Animation = {
    /**
     * Fade in element
     * @param {Element} element 
     * @param {number} duration 
     */
    fadeIn(element, duration = 300) {
        element.style.opacity = '0';
        element.style.display = 'block';
        
        const start = performance.now();
        
        function animate(timestamp) {
            const elapsed = timestamp - start;
            const progress = Math.min(elapsed / duration, 1);
            
            element.style.opacity = progress;
            
            if (progress < 1) {
                requestAnimationFrame(animate);
            }
        }
        
        requestAnimationFrame(animate);
    },

    /**
     * Fade out element
     * @param {Element} element 
     * @param {number} duration 
     */
    fadeOut(element, duration = 300) {
        const start = performance.now();
        const initialOpacity = parseFloat(getComputedStyle(element).opacity);
        
        function animate(timestamp) {
            const elapsed = timestamp - start;
            const progress = Math.min(elapsed / duration, 1);
            
            element.style.opacity = initialOpacity * (1 - progress);
            
            if (progress >= 1) {
                element.style.display = 'none';
            } else {
                requestAnimationFrame(animate);
            }
        }
        
        requestAnimationFrame(animate);
    },

    /**
     * Slide down element
     * @param {Element} element 
     * @param {number} duration 
     */
    slideDown(element, duration = 300) {
        element.style.display = 'block';
        element.style.height = '0';
        element.style.overflow = 'hidden';
        
        const targetHeight = element.scrollHeight + 'px';
        element.style.transition = `height ${duration}ms ease`;
        element.style.height = targetHeight;
        
        setTimeout(() => {
            element.style.height = '';
            element.style.overflow = '';
            element.style.transition = '';
        }, duration);
    },

    /**
     * Slide up element
     * @param {Element} element 
     * @param {number} duration 
     */
    slideUp(element, duration = 300) {
        element.style.height = element.scrollHeight + 'px';
        element.style.overflow = 'hidden';
        element.style.transition = `height ${duration}ms ease`;
        
        setTimeout(() => {
            element.style.height = '0';
        }, 10);
        
        setTimeout(() => {
            element.style.display = 'none';
            element.style.height = '';
            element.style.overflow = '';
            element.style.transition = '';
        }, duration);
    }
};

// Storage Utilities
export const Storage = {
    /**
     * Set item in localStorage
     * @param {string} key 
     * @param {*} value 
     */
    set(key, value) {
        try {
            localStorage.setItem(key, JSON.stringify(value));
        } catch (error) {
            console.warn('Failed to save to localStorage:', error);
        }
    },

    /**
     * Get item from localStorage
     * @param {string} key 
     * @param {*} defaultValue 
     * @returns {*}
     */
    get(key, defaultValue = null) {
        try {
            const item = localStorage.getItem(key);
            return item ? JSON.parse(item) : defaultValue;
        } catch (error) {
            console.warn('Failed to read from localStorage:', error);
            return defaultValue;
        }
    },

    /**
     * Remove item from localStorage
     * @param {string} key 
     */
    remove(key) {
        try {
            localStorage.removeItem(key);
        } catch (error) {
            console.warn('Failed to remove from localStorage:', error);
        }
    },

    /**
     * Clear all localStorage
     */
    clear() {
        try {
            localStorage.clear();
        } catch (error) {
            console.warn('Failed to clear localStorage:', error);
        }
    }
};

// Debounce utility
export function debounce(func, wait, immediate = false) {
    let timeout;
    
    return function executedFunction(...args) {
        const later = () => {
            timeout = null;
            if (!immediate) func.apply(this, args);
        };
        
        const callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        
        if (callNow) func.apply(this, args);
    };
}

// Throttle utility
export function throttle(func, limit) {
    let inThrottle;
    
    return function executedFunction(...args) {
        if (!inThrottle) {
            func.apply(this, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

// Format utilities
export const Format = {
    /**
     * Format number with commas
     * @param {number} num 
     * @returns {string}
     */
    number(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    },

    /**
     * Format date
     * @param {Date} date 
     * @param {string} locale 
     * @returns {string}
     */
    date(date, locale = 'pt-BR') {
        return new Intl.DateTimeFormat(locale).format(date);
    },

    /**
     * Format currency
     * @param {number} amount 
     * @param {string} currency 
     * @param {string} locale 
     * @returns {string}
     */
    currency(amount, currency = 'BRL', locale = 'pt-BR') {
        return new Intl.NumberFormat(locale, {
            style: 'currency',
            currency: currency
        }).format(amount);
    }
};

// Validation utilities
export const Validate = {
    /**
     * Validate email
     * @param {string} email 
     * @returns {boolean}
     */
    email(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    },

    /**
     * Validate URL
     * @param {string} url 
     * @returns {boolean}
     */
    url(url) {
        try {
            new URL(url);
            return true;
        } catch {
            return false;
        }
    },

    /**
     * Check if string is empty
     * @param {string} str 
     * @returns {boolean}
     */
    isEmpty(str) {
        return !str || str.trim().length === 0;
    }
}; 