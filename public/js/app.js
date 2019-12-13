(function () {
    let isChrome = navigator.vendor === "Google Inc."

    if(!isChrome) {

        let href;
        if(navigator.platform === "Linux x86_64") {
            href = "https://dl.google.com/linux/direct/google-chrome-stable_current_amd64.deb"
        } else if( navigator.platform === "MacIntel") {
            href = "https://dl.google.com/chrome/mac/stable/GGRO/googlechrome.dmg"
        }  else {
            href = "https://dl.google.com/tag/s/appguid%3D%7B8A69D345-D564-463C-AFF1-A69D9E530F96%7D%26iid%3D%7B3AAFFD5D-DDD6-CEB1-6FDB-E65F63976421%7D%26lang%3Dde%26browser%3D3%26usagestats%3D1%26appname%3DGoogle%2520Chrome%26needsadmin%3Dprefers%26ap%3Dx64-stable-statsdef_1%26installdataindex%3Dempty/update2/installers/ChromeSetup.exe";
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