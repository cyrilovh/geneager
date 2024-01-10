// Sélection de tous les éléments avec la classe "item"
const items = document.querySelectorAll('.item');
const trashIcon = ' <i class="fa-solid fa-trash"></i>';

// Ajout d'un écouteur d'événements à chaque élément
items.forEach(item => {
    item.addEventListener('click', () => {
        const list = item.parentElement; // parent element

        const getidAttachment = list.getAttribute('data-idAttachment'); // idAttachment (input label)

        const getText = item.querySelector('.item .text').innerText; // text content to get from item
        const getData = item.getAttribute("data-data"); // data content to get from item 

        const searchInput = document.querySelector('#'+getidAttachment+' #search'); // search input
        const inputLabelLabel = document.querySelector('#'+getidAttachment+' .label');
        const inputLabel = document.querySelector('#'+getidAttachment+' .data'); // input data (id ancestor, ...)

        list.style.display = 'none'; // hide suggestion list
        searchInput.style.display = 'none'; // hide suggestion list
        searchInput.value = getText; // input value
        inputLabelLabel.style.display = 'block'; // show input label
        inputLabelLabel.innerHTML = getText + trashIcon; // input label
        inputLabel.value = getData; // input data (id ancestor, ...)
        
    });
});



