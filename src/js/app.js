document.addEventListener('DOMContentLoaded', function() {
    getCategories();
    mobileMenu();
    dropDown();
    disabledDrop();
});


function getCategories(){
    const tabButtons = document.querySelectorAll('.tab-button');
    const toolsContainer = document.getElementById('toolsContainer');

    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const categoryId = this.getAttribute('data-category-id');
            
            // Remove 'active' class from all buttons
            tabButtons.forEach(btn => btn.classList.remove('active'));
            // Add 'active' class to clicked button
            this.classList.add('active');

            // Fetch tools for the selected category
            fetch(`get_tools_by_category.php?category_id=${categoryId}`)
                .then(response => response.json())
                .then(tools => {
                    // Clear current tools
                    toolsContainer.innerHTML = '';

                    // Add new tools
                    tools.forEach(tool => {
                        const toolCard = `
                            <div class="card">
                                <h3>${tool.name}</h3>
                                <p>${tool.description}</p>
                                <a href="${tool.url}" class="button">Explorar</a>
                            </div>
                        `;
                        toolsContainer.innerHTML += toolCard;
                    });
                })
                .catch(error => console.error('Error:', error));
        });
    });
}

function disabledDrop(){
    const header = document.querySelector('.header')
    const dropdown = document.querySelector('.nav .dropdown')
    const nodropdown = document.querySelector('.nav .no-drop')

    if(header.classList.contains('inicio')){
        dropdown.style.display = 'none'
    } else {
        nodropdown.style.display = 'none'
    }
}

function mobileMenu(){
    const menu = document.querySelector('.menu');
    menu.addEventListener('click', showMenu)
}

function showMenu(){
    const navigation = document.querySelector('.nav')
    navigation.classList.toggle('show-menu')

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 768) { // Cambia este valor según tus necesidades
            navigation.classList.remove('show-menu'); // Oculta el menú en pantallas grandes
        } else {
            navigation.classList.remove('show-menu'); // También oculta en pantallas pequeñas por defecto
        }
    });
}

function dropDown(){
    const dropdown = document.querySelector('.dropdown')
    dropdown.addEventListener('click', showCategories)
}

function showCategories(){
    const categories = document.querySelector('.categories')
    const rotate = document.querySelector('.icon-tabler-chevron-down')
    categories.classList.toggle('show-list')
    rotate.classList.toggle('rotate')

    window.addEventListener('resize', () => {
        if (window.innerWidth >= 768) { // Cambia este valor según tus necesidades
            categories.classList.remove('show-list'); // Oculta el menú en pantallas grandes
        } else {
            categories.classList.remove('show-list'); // También oculta en pantallas pequeñas por defecto
        }
    });
}

// const tools = [
//     { id: 1, name: 'AI Code Assistant', category: 'ai', description: 'Asistente de código impulsado por IA' },
//     { id: 2, name: 'Gradient Master', category: 'gradients', description: 'Crea hermosos gradientes' },
//     { id: 3, name: '3D Model Viewer', category: '3d', description: 'Visualiza modelos 3D en el navegador' },
//     { id: 4, name: 'Icon Forge', category: 'icons', description: 'Biblioteca de iconos personalizables' },
//     { id: 5, name: 'AI Image Generator', category: 'ai', description: 'Genera imágenes con IA' },
//     { id: 6, name: 'CSS Gradient Tool', category: 'gradients', description: 'Herramienta para crear gradientes CSS' },
//     { id: 7, name: '3D Text Creator', category: '3d', description: 'Crea texto en 3D para tus proyectos' },
//     { id: 8, name: 'SVG Icon Editor', category: 'icons', description: 'Edita y personaliza iconos SVG' },
//     { id: 9, name: 'Task Manager', category: 'productivity', description: 'Gestiona tus tareas de desarrollo' },
//     { id: 10, name: 'Code Snippet Library', category: 'productivity', description: 'Almacena y organiza snippets de código' },
//     { id: 11, name: 'AI Content Writer', category: 'ai', description: 'Genera contenido con inteligencia artificial' },
//     { id: 12, name: 'Color Palette Generator', category: 'gradients', description: 'Crea paletas de colores armoniosas' },
//     { id: 13, name: '3D Animation Tool', category: '3d', description: 'Crea animaciones 3D para la web' },
//     { id: 14, name: 'Icon Animation Creator', category: 'icons', description: 'Crea iconos animados para tus proyectos' },
//     { id: 15, name: 'Pomodoro Timer', category: 'productivity', description: 'Mejora tu productividad con la técnica Pomodoro' },
//     { id: 16, name: 'AI Code Reviewer', category: 'ai', description: 'Revisa tu código con inteligencia artificial' },
//     { id: 17, name: 'AI Code Reviewer', category: 'ai', description: 'Revisa tu código con inteligencia artificial' },
//     { id: 18, name: 'AI Code Reviewer', category: 'ai', description: 'Revisa tu código con inteligencia artificial' },
//     { id: 19, name: 'AI Code Reviewer', category: 'ai', description: 'Revisa tu código con inteligencia artificial' },
//     { id: 20, name: 'AI Code Reviewer', category: 'ai', description: 'Revisa tu código con inteligencia artificial' },
//     { id: 21, name: 'AI Code Reviewer', category: 'ai', description: 'Revisa tu código con inteligencia artificial' },
//     { id: 22, name: 'AI Code Reviewer', category: 'ai', description: 'Revisa tu código con inteligencia artificial' },
//     { id: 23, name: 'AI Code Reviewer', category: 'ai', description: 'Revisa tu código con inteligencia artificial' },
//     { id: 24, name: 'AI Code Reviewer', category: 'ai', description: 'Revisa tu código con inteligencia artificial' },
//     { id: 25, name: 'AI Code Reviewer', category: 'ai', description: 'Revisa tu código con inteligencia artificial' },
// ];

// let visibleTools = 8;
// let activeCategory = 'ai';
// let isLoading = false;

// const toolsContainer = document.getElementById('toolsContainer');
// const loadMoreBtn = document.getElementById('loadMoreBtn');
// const tabButtons = document.querySelectorAll('.tab-button');

// setTimeout(function() {
//     var alerta = document.getElementById('alerta');
//     alerta.style.opacity = '0';
//     setTimeout(function() {
//         alerta.style.display = 'none';
//     }, 500); // Wait for fade out animation to complete
// }, 3000);

// function renderTools() {
//     const filteredTools = tools.filter(tool => tool.category === activeCategory);
//     const toolsToShow = filteredTools.slice(0, visibleTools);

//     toolsContainer.innerHTML = toolsToShow.map(tool => `
//         <div class="card">
//             <h3>${tool.name}</h3>
//             <p>${tool.description}</p>
//             <button class="button">Explorar</button>
//         </div>
//     `).join('');

//     // Aplicar la transición a las nuevas tarjetas
//     setTimeout(() => {
//         document.querySelectorAll('.card').forEach(card => {
//             card.classList.add('visible');
//         });
//     }, 50);

//     loadMoreBtn.style.display = visibleTools < filteredTools.length ? 'inline-block' : 'none';
// }

// function loadMore() {
//     if (isLoading) return;
    
//     isLoading = true;
//     loadMoreBtn.disabled = true;
//     loadMoreBtn.textContent = 'Cargando...';

//     setTimeout(() => {
//         visibleTools += 4;
//         renderTools();
//         isLoading = false;
//         loadMoreBtn.disabled = false;
//         loadMoreBtn.textContent = 'Ver más';
//     }, 1000); // Simula una carga de 1 segundo
// }

// function changeCategory(category) {
//     if (category === activeCategory) return;

//     activeCategory = category;
//     visibleTools = 8;

//     // Ocultar las tarjetas actuales
//     document.querySelectorAll('.card').forEach(card => {
//         card.classList.remove('visible');
//     });

//     // Esperar a que termine la transición de ocultamiento
//     setTimeout(() => {
//         renderTools();
//     }, 500);

//     updateActiveTab();
// }

// function updateActiveTab() {
//     tabButtons.forEach(button => {
//         if (button.dataset.category === activeCategory) {
//             button.classList.add('active');
//         } else {
//             button.classList.remove('active');
//         }
//     });
// }

// loadMoreBtn.addEventListener('click', loadMore);

// tabButtons.forEach(button => {
//     button.addEventListener('click', () => changeCategory(button.dataset.category));
// });

// // Initial render
// renderTools();
// updateActiveTab();