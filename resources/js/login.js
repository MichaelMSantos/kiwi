const gradientElement = document.getElementById('gradient');

function handleScroll() {
    const scrollPosition = window.scrollY + window.innerHeight;
    const gradientBottom = gradientElement.offsetTop + gradientElement.offsetHeight;

    if (scrollPosition >= gradientBottom) {
        gradientElement.style.background = 'rgb(0,36,1)';
        gradientElement.style.background = '-moz-linear-gradient(290deg, rgba(0,36,1,1) 0%, rgba(23,24,16,1) 20%)';
        gradientElement.style.background = '-webkit-linear-gradient(290deg, rgba(0,36,1,1) 0%, rgba(23,24,16,1) 20%)';
        gradientElement.style.background = 'linear-gradient(290deg, rgba(0,36,1,1) 0%, rgba(23,24,16,1) 20%)';
        gradientElement.style.filter = 'progid:DXImageTransform.Microsoft.gradient(startColorstr="#002401",endColorstr="#171810",GradientType=1)';
    } else {
        gradientElement.style.background = 'rgb(0,36,1)';
        gradientElement.style.background = '-moz-linear-gradient(127deg, rgba(0,36,1,1) 0%, rgba(23,24,16,1) 20%)';
        gradientElement.style.background = '-webkit-linear-gradient(127deg, rgba(0,36,1,1) 0%, rgba(23,24,16,1) 20%)';
        gradientElement.style.background = 'linear-gradient(127deg, rgba(0,36,1,1) 0%, rgba(23,24,16,1) 20%)';
        gradientElement.style.filter = 'progid:DXImageTransform.Microsoft.gradient(startColorstr="#002401",endColorstr="#171810",GradientType=1)';
    }
}

window.addEventListener('scroll', handleScroll);