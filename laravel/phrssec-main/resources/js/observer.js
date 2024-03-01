const myObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        
        if (entry.isIntersecting) {
            entry.target.classList.add('animate__fadeInLeft')
        }else{
            entry.target.classList.remove('animate__fadeInLeft')
        }
        
    })
})

const animacao = document.querySelectorAll('.animate__animated');
animacao.forEach(element => {
    myObserver.observe(element)
});

document.documentElement.style.setProperty('--animate-duration', '1.5s');