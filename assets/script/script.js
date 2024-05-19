function buttonToggle() {
    const buttonSetting = document.getElementById("settings");

    if (buttonSetting.classList.contains("hidden")) {
        buttonSetting.classList.add("block");
        buttonSetting.classList.remove("hidden");
    }
    else {
        buttonSetting.classList.remove("block");
        buttonSetting.classList.add("hidden");
    }
}

function activate() {
    const crossSvg = document.getElementById("cross");
    const burgerSvg = document.getElementById("burger");
    const navigationButton = document.getElementById("navigation");
    const nav = ["max-sm:flex-col", "max-sm:px-4", "max-sm:absolute", "max-sm:top-14", "max-sm:bg-slate-800", "max-sm:w-full", "max-sm:left-0", "max-sm:gap-1", "max-sm:pb-2", "max-sm:rounded-b-lg"];

    if (crossSvg.classList.contains("hidden")) {
        crossSvg.classList.remove("hidden");
        crossSvg.classList.add("block");
        burgerSvg.classList.remove("max-sm:block");
        navigationButton.classList.remove("max-sm:hidden");
        nav.forEach(element => {
            navigationButton.classList.add("element");
        });
    }
    else {
        crossSvg.classList.remove("block");
        crossSvg.classList.add("hidden");
        burgerSvg.classList.add("max-sm:block");
        navigationButton.classList.add("max-sm:hidden");
        nav.forEach(element => {
            navigationButton.classList.remove("element");
        });
    }
}