const GOODS = [{
        category: 'furniture',
        name: 'Chair',
        amount: 1,
        price: 20
    },
    {
        category: 'supplies',
        name: 'Gel Pen',
        amount: 20,
        price: 2
    },
    {
        category: 'other',
        name: 'Trash Bin',
        amount: 1,
        price: 5
    },
    {
        category: 'furniture',
        name: 'Sofa',
        amount: 1,
        price: 50
    },
    {
        category: 'supplies',
        name: 'Notebook',
        amount: 3,
        price: 3
    },
    {
        category: 'other',
        name: 'Calendar 2019',
        amount: 1,
        price: 3
    }
];

runToResult();

const input = document.getElementById("input");
input.oninput = function() {
    runToResult();
}


const select = document.getElementById("select");
select.onchange = function() {
    runToResult();
}

function checkPosition(li) {
    const id = li.id;

    if (li.innerHTML == "▼") {
        li.innerHTML = "&#9650";
    } else {
        li.innerHTML = "&#9660";
    }
    sortToAlphab(id);
}



function sortToAlphab(id) {
    let sortItem = document.getElementById(id);
    let sortValue = '';

    if (id == "sortCategory") {
        sortValue = "category";
    } else {
        sortValue = "name";
    }

    if (sortItem.innerHTML == "▼") {
        const propComparator = (propName) =>
            (a, b) => a[propName] == b[propName] ? 0 : a[propName] < b[propName] ? -1 : 1;

        GOODS.sort(propComparator(sortValue));
    } else {
        const propComparator = (propName) =>
            (a, b) => a[propName] == b[propName] ? 0 : a[propName] > b[propName] ? -1 : 1;

        GOODS.sort(propComparator(sortValue));
    }
    runToResult();

}



function runToResult() {
    const input = document.getElementById("input");
    const select = document.getElementById("select");
    let tbody = document.getElementById("tbody");
    tbody.innerHTML = "";
    let total = document.getElementById("total");
    let regex = new RegExp(input.value, "i");
    let sum = 0;
    let goods2;

    if (input.value) {
        goods2 = GOODS.filter((item) => item.name.match(regex));
        if(select.value){
            goods2 = filterBySelect(goods2);
        }
    } else if (select.value) {
        goods2 = GOODS.filter((item) => item.category == select.value);
    } else {
        goods2 = GOODS;
    }
    tbody.innerHTML += goods2.map((item) => {
        sum += item.amount * item.price;
        return `<tr>
                    <td>${item.category}</td>
                    <td>${item.name}</td>
                    <td>${item.amount}</td>
                    <td>${item.price}</td>
                </tr>`
    }).join(' ');
    total.innerHTML = sum + "$";
}

function filterBySelect (arr){
    let goods2 = arr.filter((item) => item.category == select.value);
    return goods2;
}
