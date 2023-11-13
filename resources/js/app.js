import './bootstrap';

const darkMode = document.querySelector('#darkMode')

darkMode.addEventListener('click', () => {
    document.documentElement.classList.toggle('dark');
})
