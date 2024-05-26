const gradientElements = document.querySelectorAll('.gradient-effect');

function handleMouseMove(event) {
    gradientElements.forEach(gradientElement => {
        const rect = gradientElement.getBoundingClientRect();
        const mouseX = event.clientX - rect.left;
        const mouseY = event.clientY - rect.top;

        const percentageX = (mouseX / rect.width) * 100;
        const percentageY = (mouseY / rect.height) * 100;

        gradientElement.style.background = `radial-gradient(circle at ${percentageX}% ${percentageY}%, rgba(0,36,1,1), rgba(23,24,16,1) 20%)`;
    });
}

document.addEventListener('mousemove', handleMouseMove);
