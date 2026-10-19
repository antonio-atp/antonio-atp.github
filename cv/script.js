// ===== MENU MOBILE =====
const hamburger = document.getElementById('nav-hamburger');
const navMenu = document.getElementById('nav-menu');

hamburger.addEventListener('click', () => {
    hamburger.classList.toggle('open');
    navMenu.classList.toggle('open');
});

// Fechar o menu ao clicar num link
document.querySelectorAll('.nav__link').forEach(link => {
    link.addEventListener('click', () => {
        hamburger.classList.remove('open');
        navMenu.classList.remove('open');
    });
});

// ===== MODO ESCURO/CLARO =====
const themeToggle = document.getElementById('theme-toggle');
const temaGuardado = localStorage.getItem('tema');

if (temaGuardado === 'dark') {
    document.documentElement.setAttribute('data-theme', 'dark');
    themeToggle.textContent = '☀️';
}

themeToggle.addEventListener('click', () => {
    const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
    document.documentElement.setAttribute('data-theme', isDark ? 'light' : 'dark');
    themeToggle.textContent = isDark ? '🌙' : '☀️';
    localStorage.setItem('tema', isDark ? 'light' : 'dark');
});

// ===== EFEITO MÁQUINA DE ESCREVER =====
const palavras = ['Developer', 'Programador', 'Criador'];
const typedEl = document.getElementById('typed');
let palavraIndex = 0, letraIndex = 0, apagar = false;

function escrever() {
    const palavra = palavras[palavraIndex];
    typedEl.textContent = palavra.substring(0, letraIndex);

    if (!apagar && letraIndex < palavra.length) {
        letraIndex++;
        setTimeout(escrever, 120);
    } else if (apagar && letraIndex > 0) {
        letraIndex--;
        setTimeout(escrever, 60);
    } else {
        apagar = !apagar;
        if (!apagar) palavraIndex = (palavraIndex + 1) % palavras.length;
        setTimeout(escrever, apagar ? 1500 : 300);
    }
}
escrever();

// ===== ANIMAÇÕES AO FAZER SCROLL (Intersection Observer) =====
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');

            // Animar barras de competências
            entry.target.querySelectorAll('.skill__progress').forEach(bar => {
                bar.style.width = bar.dataset.width + '%';
            });

            // Animar contadores
            entry.target.querySelectorAll('.card-info__num').forEach(num => {
                animarContador(num);
            });

            observer.unobserve(entry.target);
        }
    });
}, { threshold: 0.15 });

document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

// ===== CONTADORES ANIMADOS =====
function animarContador(el) {
    const alvo = parseInt(el.dataset.count);
    let atual = 0;
    const passo = Math.max(1, Math.floor(alvo / 30));
    const intervalo = setInterval(() => {
        atual += passo;
        if (atual >= alvo) {
            atual = alvo;
            clearInterval(intervalo);
        }
        el.textContent = atual + '+';
    }, 50);
}

// ===== LINK ATIVO NA NAVEGAÇÃO =====
const secoes = document.querySelectorAll('section[id]');
window.addEventListener('scroll', () => {
    const scrollY = window.scrollY + 100;
    secoes.forEach(secao => {
        const topo = secao.offsetTop;
        const altura = secao.offsetHeight;
        const link = document.querySelector(`.nav__link[href="#${secao.id}"]`);
        if (link) {
            link.classList.toggle('active', scrollY >= topo && scrollY < topo + altura);
        }
    });

    // Botão voltar ao topo
    document.getElementById('scroll-top').classList.toggle('visible', window.scrollY > 400);
});

// ===== VOLTAR AO TOPO =====
document.getElementById('scroll-top').addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});

// ===== FORMULÁRIO DE CONTACTO =====
const form = document.getElementById('contact-form');
const formFeedback = document.getElementById('form-feedback');
const btnSubmit = document.getElementById('btn-submit');

form.addEventListener('submit', async (e) => {
    e.preventDefault();

    const nome = document.getElementById('nome').value;
    const url = form.getAttribute('action');
    const formData = new FormData(form);

    if (url.includes('SEU_ID_AQUI')) {
        formFeedback.style.color = '#eab308';
        formFeedback.textContent = "Aviso: Substitua 'SEU_ID_AQUI' pelo seu link real do Formspree no ficheiro HTML.";
        return;
    }

    btnSubmit.textContent = "A enviar...";
    btnSubmit.disabled = true;

    try {
        const response = await fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json'
            }
        });

        if (response.ok) {
            formFeedback.style.color = '#22c55e';
            formFeedback.textContent = `Obrigado, ${nome}! A sua mensagem foi enviada. ✅`;
            form.reset();
        } else {
            formFeedback.style.color = '#ef4444';
            formFeedback.textContent = "Erro ao enviar. Tente novamente.";
        }
    } catch (error) {
        formFeedback.style.color = '#ef4444';
        formFeedback.textContent = "Erro de conexão. Verifique a sua internet.";
    } finally {
        btnSubmit.textContent = "Enviar Mensagem";
        btnSubmit.disabled = false;
    }
});

// ===== ANO NO FOOTER =====
document.getElementById('ano').textContent = new Date().getFullYear();