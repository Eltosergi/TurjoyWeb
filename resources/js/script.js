function showTooltip(event) {
    const tooltip = document.getElementById("tooltip");
    tooltip.style.display = "block";
    tooltip.style.left = event.clientX + "px";
    tooltip.style.top = event.clientY + 20 + "px"; // 20px abajo del puntero del mouse
}

function hideTooltip() {
    const tooltip = document.getElementById("tooltip");
    tooltip.style.display = "none";
}