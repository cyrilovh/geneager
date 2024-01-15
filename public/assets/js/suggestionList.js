// I select all suggestion list who can be modified
const listList = document.querySelectorAll('[data-idAttachment]');

const trashIcon = ' <i class="fa-solid fa-trash" onclick="removeLabel();"></i>';

// for each suggestion list i check if there is a modification for item be clicked
listList.forEach(list => {
    // SUGGEST LIST CHANGES
    // Créez une instance de MutationObserver et spécifiez une fonction de rappel
    const observerList = new MutationObserver(() => {

        // Ajout d'un écouteur d'événements à chaque élément
        const itemList = document.querySelectorAll('.item');
        itemList.forEach(item => {
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

    });
    
    // Configurez les options de l'observateur (observez les modifications du contenu de l'élément et les sous-arbres)
    const options = { childList: true, subtree: true };
    
    // Commencez à observer la div avec les options spécifiées
    observerList.observe(list, options);
    
});








