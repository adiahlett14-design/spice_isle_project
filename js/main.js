document.addEventListener('DOMContentLoaded', ()=>{
    const btn = document.getElementById('nav-toggle');
    const nav = document.getElementById('main-nav');
    if(btn && nav){
        btn.addEventListener('click', ()=>{
            const expanded = btn.getAttribute('aria-expanded') === 'true';
            btn.setAttribute('aria-expanded', String(!expanded));
            nav.classList.toggle('show');
        });
    }
});
