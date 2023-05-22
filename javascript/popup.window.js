"use strict";
// Mobile Menu Icon
let menuIcon = document.querySelector('#menu-icon');
let navBar = document.querySelector('nav');

menuIcon.onclick = () => {
    menuIcon.classList.toggle('bx-x');
    navBar.classList.toggle('active');
};

// Popup Windows - for Login, New Resume, Delete Account
const openWindowButtons = document.querySelectorAll('[data-window-target]');
const closeWindowButtons = document.querySelectorAll('[data-window-close]');
const overlay = document.getElementById('overlay');

openWindowButtons.forEach(button => {
    button.addEventListener('click', () => {
        const window = document.querySelector(button.dataset.windowTarget);
        openWindow(window);
    });
});

closeWindowButtons.forEach(button => {
    button.addEventListener('click', () => {
        const window = button.closest('.window');
        closeWindow(window);
    });
});

overlay.addEventListener('click', () => {
    const windows = document.querySelectorAll('.window.active');
    windows.forEach(window => {
        closeWindow(window);
    });
});

function openWindow(window) {
    if (window == null) return
    window.classList.add('active');
    overlay.classList.add('active');
}

function closeWindow(window) {
    if (window == null) return
    window.classList.remove('active');
    overlay.classList.remove('active');
}

// Second Popup Windows - for Delete Resume
const openDeleteWindows = document.querySelectorAll('[data-window-delopen]');
const closeDeleteWindows = document.querySelectorAll('[data-window-delclose]');

openDeleteWindows.forEach(button => {
    button.addEventListener('click', () => {
        const window = document.querySelector(button.dataset.windowDelopen);
        openDelWindow(window);
    });
});

closeDeleteWindows.forEach(button => {
    button.addEventListener('click', () => {
        const window = button.closest('.window');
        closeWindow(window);
    });
});

function openDelWindow(window) {
    if (window == null) return
    window.classList.add('active');
    overlay.classList.add('active');
}

function closeDelWindow(window) {
    if (window == null) return
    window.classList.remove('active');
    overlay.classList.remove('active');
}