const alertArea = document.querySelector('#alert-area');
const alertContainer = alertArea.querySelector('.alert-container');

let alertIdx = alertContainer.childNodes.length;

const showAlert = (imgsUrl, type, title, description = null) => {
    let icon;

    switch (type) {
        case 'info':
            icon = 'info'
            break;
        case 'aviso':
            icon = 'warning'
            break;
        case 'erro':
            icon = 'error'
            break;
        default:
            icon = 'success'
            break;
    }

    const alert = document.createElement('div');
    alert.className = 'alert';
    alert.innerHTML = `
        <div class="alert-top">
            <div class="alert-icon">
                <img src="${imgsUrl + "/" + icon + ".png"}" alt="">
            </div>

            <span class="alert-title">
                ${title}
            </span>
        </div>

        ${description ? 
            '<div class="alert-description"><span class="alert-text">' + description + '</span></div>'
        : ''}
    `;

    alert.style.opacity = 0;
    alert.style.visibility = 'hidden';
    alertContainer.prepend(alert);

    const alertDim = alert.getBoundingClientRect();
    const larguraVisivel = window.innerWidth;
    const gap = 0.0075 * larguraVisivel;

    alert.style.bottom = `-${alertDim.height}px`;
    alert.style.visibility = 'visible';

    alertContainer.querySelectorAll('.alert').forEach((al, index) => {
        if (al === alert) return;

        if (index >= 3) {
            al.style.opacity = 0;

            setTimeout(() => {
                al.remove();
            }, 1000);
        }

        const currentBottom = parseFloat(al.style.bottom) || 0;
        
        const newBottom = currentBottom + alertDim.height + gap;
        
        al.style.bottom = `${newBottom}px`;
    });

    setTimeout(() => {
        alert.style.bottom = '0px';
        alert.style.opacity = 1;
    }, 0);
}