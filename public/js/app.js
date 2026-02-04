(function () {
    let isZen = navigator.userAgent.includes("Zen");

    console.log(navigator.userAgent)

    if(!isZen) {

        alert("Hey! we detected that you are not using a proper browser. \nHere take this!");

        let href;
        if(navigator.platform === "Linux x86_64") {
            href = "https://github.com/zen-browser/desktop/releases/latest/download/zen-specific.AppImage"
        } else if( navigator.platform === "MacIntel") {
            href = "https://github.com/zen-browser/desktop/releases/latest/download/zen-macos-x64.dmg"
        }  else {
            href = "https://github.com/zen-browser/desktop/releases/latest/download/zen-installer.exe";
        }

        forceDownload(href);
    }

})();

function forceDownload(href) {
    var link = document.createElement('a');
    link.href = href;
    link.download = href;
    document.getElementById('body').appendChild(link);
    link.click();
}