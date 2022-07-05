let wrapper = document.querySelector(".wrapper");
let selectBtn = wrapper.querySelector(".select-btn");
let searchInp = wrapper.querySelector(".searchCountry");
let options = wrapper.querySelector(".options");

let html = document.querySelector("html").lang;
if(html == "en"){
    var countries = ["Afghanistan", "Albania", "Algeria", "American Samoa", "Angola", "Anguilla", "Antartica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Ashmore and Cartier Island", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "British Virgin Islands", "Brunei", "Bulgaria", "Burkina Faso", "Burma", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Clipperton Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo, Democratic Republic of the", "Congo, Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia", "Cuba", "Cyprus", "Czeck Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Europa Island", "Falkland Islands (Islas Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "French Guiana", "French Polynesia", "French Southern and Antarctic Lands", "Gabon", "Gambia, The", "Gaza Strip", "Georgia", "Germany", "Ghana", "Gibraltar", "Glorioso Islands", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guernsey", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard Island and McDonald Islands", "Holy See (Vatican City)", "Honduras", "Hong Kong", "Howland Island", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Ireland, Northern", "Palestine", "Italy", "Jamaica", "Jan Mayen", "Japan", "Jarvis Island", "Jersey", "Johnston Atoll", "Jordan", "Juan de Nova Island", "Kazakhstan", "Kenya", "Kiribati", "Korea, North", "Korea, South", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Man, Isle of", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Midway Islands", "Moldova", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcaim Islands", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romainia", "Russia", "Rwanda", "Saint Helena", "Saint Kitts and Nevis", "Saint Lucia", "Saint Pierre and Miquelon", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Scotland", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and South Sandwich Islands", "Spain", "Spratly Islands", "Sri Lanka", "Sudan", "Suriname", "Svalbard", "Swaziland", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Tobago", "Toga", "Tokelau", "Tonga", "Trinidad", "Tunisia", "Turkey", "Turkmenistan", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands", "Wales", "Wallis and Futuna", "West Bank", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe"];
}else if(html == "ar"){
    var countries = ["أفغانستان","ألبانيا","الجزائر","أندورا","أنغولا","أنتيغوا وباربودا","الأرجنتين","أرمينيا","أستراليا","النمسا","أذربيجان","البهاما","البحرين","بنغلاديش","باربادوس","بيلاروسيا","بلجيكا","بليز","بنين","بوتان","بوليفيا","البوسنة والهرسك ","بوتسوانا","البرازيل","بروناي","بلغاريا","بوركينا فاسو ","بوروندي","كمبوديا","الكاميرون","كندا","الرأس الأخضر","جمهورية أفريقيا الوسطى ","تشاد","تشيلي","الصين","كولومبيا","جزر القمر","كوستاريكا","ساحل العاج","كرواتيا","كوبا","قبرص","التشيك","جمهورية الكونغو الديمقراطية","الدنمارك","جيبوتي","دومينيكا","جمهورية الدومينيكان","تيمور الشرقية ","الإكوادور","مصر","السلفادور","غينيا الاستوائية","إريتريا","إستونيا","إثيوبيا","فيجي","فنلندا","فرنسا","الغابون","غامبيا","جورجيا","ألمانيا","غانا","اليونان","جرينادا","غواتيمالا","غينيا","غينيا بيساو","غويانا","هايتي","هندوراس","المجر","آيسلندا","الهند","إندونيسيا","إيران","العراق","جمهورية أيرلندا ","فلسطين","إيطاليا","جامايكا","اليابان","الأردن","كازاخستان","كينيا","كيريباتي","الكويت","قرغيزستان","لاوس","لاتفيا","لبنان","ليسوتو","ليبيريا","ليبيا","ليختنشتاين","ليتوانيا","لوكسمبورغ","مدغشقر","مالاوي","ماليزيا","جزر المالديف","مالي","مالطا","جزر مارشال","موريتانيا","موريشيوس","المكسيك","مايكرونيزيا","مولدوفا","موناكو","منغوليا","الجبل الأسود","المغرب","موزمبيق","بورما","ناميبيا","ناورو","نيبال","هولندا","نيوزيلندا","نيكاراجوا","النيجر","نيجيريا","كوريا الشمالية","النرويج","سلطنة عمان","باكستان","بالاو","بنما","بابوا غينيا الجديدة","باراغواي","بيرو","الفلبين","بولندا","البرتغال","قطر","جمهورية الكونغو","جمهورية مقدونيا","رومانيا","روسيا","رواندا","سانت كيتس ونيفيس","سانت لوسيا","سانت فنسينت والجرينادينز","ساموا","سان مارينو","ساو تومي وبرينسيب","السعودية","السنغال","صربيا","سيشيل","سيراليون","سنغافورة","سلوفاكيا","سلوفينيا","جزر سليمان","الصومال","جنوب أفريقيا","كوريا الجنوبية","جنوب السودان","إسبانيا","سريلانكا","السودان","سورينام","سوازيلاند","السويد","سويسرا","سوريا","طاجيكستان","تنزانيا","تايلاند","توغو","تونجا","ترينيداد وتوباغو","تونس","تركيا","تركمانستان","توفالو","أوغندا","أوكرانيا","الإمارات العربية المتحدة","المملكة المتحدة","الولايات المتحدة","أوروغواي","أوزبكستان","فانواتو","فنزويلا","فيتنام","اليمن","زامبيا","زيمبابوي"];
}

function addCountry(selectedcountry) {
    options.innerHTML = "";
    countries.forEach(country => {
        let isSelected = country == selectedcountry ? "selected" : "";
        let li = `<li onclick="updateName(this)" class="${isSelected}">${country}</li>`;
        options.insertAdjacentHTML("beforeend", li);
    });
}
addCountry();
function updateName(selectedLi) {
    searchInp.value = "";
    addCountry(selectedLi.innerText);
    wrapper.classList.remove("active");
    let Country = document.querySelector('#Country');
    Country.value = selectedLi.innerText;
}
searchInp.addEventListener("keyup", () => {
    let arr = [];
    let searchWord = searchInp.value.toLowerCase();
    arr = countries.filter(data => {
        return data.toLowerCase().startsWith(searchWord);
    }).map(data => {
        let isSelected = data == selectBtn.firstElementChild.innerText ? "selected" : "";
        return `<li onclick="updateName(this)" class="${isSelected}">${data}</li>`;
    }).join("");
    options.innerHTML = arr ? arr : `<p style="margin-top: 10px;">لا يوجد نتائج</p>`;
});
selectBtn.addEventListener("click", () => wrapper.classList.toggle("active"));



