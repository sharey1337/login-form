document.addEventListener('DOMContentLoaded', function() {
    function createSnowflake() {
        const snowflake = document.createElement('div');
        snowflake.classList.add('snowflake');
        snowflake.style.left = Math.random() * window.innerWidth + 'px';
        snowflake.style.animationDuration = Math.random() * 3 + 2 + 's'; // falling speed
        snowflake.style.opacity = Math.random();
        snowflake.style.fontSize = Math.random() * 10 + 10 + 'px';
        
        document.body.appendChild(snowflake);

        setTimeout(() => {
            snowflake.remove();
        }, 5000); // remove snowflake after 5 seconds
    }

    setInterval(createSnowflake, 100);
});
