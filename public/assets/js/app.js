const menuToggle = document.querySelector('.menu-toggle');
const sidebar = document.querySelector('.sidebar');

menuToggle?.addEventListener('click', () => {
    const isOpen = sidebar.classList.toggle('sidebar-open');
    menuToggle.setAttribute('aria-expanded', String(isOpen));
});

document.querySelectorAll('form[data-confirm]').forEach((form) => {
    form.addEventListener('submit', (event) => {
        if (!window.confirm(form.dataset.confirm)) {
            event.preventDefault();
        }
    });
});
