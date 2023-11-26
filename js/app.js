document.querySelectorAll('.sidebar-submenu').forEach(e => {
    e.querySelector('.sidebar-menu-dropdown').onclick = (event) => {
        event.preventDefault()
        e.querySelector('.sidebar-menu-dropdown .dropdown-icon').classList.toggle('active')

        let dropdown_content = e.querySelector('.sidebar-menu-dropdown-content')
        let dropdown_content_lis = dropdown_content.querySelectorAll('li')

        let active_height = dropdown_content_lis[0].clientHeight * dropdown_content_lis.length

        dropdown_content.classList.toggle('active')

        dropdown_content.style.height = dropdown_content.classList.contains('active') ? active_height + 'px' : '0'
    }
})



let category_chart = new ApexCharts(document.querySelector("#category-chart"), category_options)
category_chart.render()

let customer_options = {
    series: [{
        name: "Store Customers",
        data: [40, 70, 20, 90, 36, 80, 30, 91, 60]
    },{
        name: "Online Customers",
        data: [20, 30, 10, 20, 16, 40, 20, 51, 10]
    }],
    colors: ['#6ab04c', '#2980b9'],
    chart: {
        height: 350,
        type: 'line',
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        curve: 'smooth'
    },
    xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
    },
    legend: {
        position: 'top'
    }
}

let customer_chart = new ApexCharts(document.querySelector("#customer-chart"), customer_options)
customer_chart.render()

setDarkChart = (dark) => {
    let theme = {
        theme: {
            mode: dark ? 'dark' : 'light'
        }
    }

    customer_chart.updateOptions(theme)
    category_chart.updateOptions(theme)
} 

// DARK MODE TOGGLE
let darkmode_toggle = document.querySelector('#darkmode-toggle')

// Ajoute un gestionnaire d'événements au clic sur l'élément darkmode_toggle
darkmode_toggle.onclick = (e) => {
     // Empêche le comportement par défaut de l'événement de clic (par exemple, la navigation vers une nouvelle page)
    e.preventDefault()
     // Récupère l'élément du DOM associé à body et bascule la classe 'dark' sur cet élément
    document.querySelector('body').classList.toggle('dark')
    // Récupère l'élément avec la classe 'darkmode-switch' à l'intérieur de darkmode_toggle et bascule la classe 'active' sur cet élément
    darkmode_toggle.querySelector('.darkmode-switch').classList.toggle('active')
    // Appelle la fonction setDarkChart avec la valeur actuelle du mode sombre (true si 'dark' est présent, sinon false)
    setDarkChart(document.querySelector('body').classList.contains('dark'))
}

let overlay = document.querySelector('.overlay')
let sidebar = document.querySelector('.sidebar')

document.querySelector('#mobile-toggle').onclick = () => {
    sidebar.classList.toggle('active')
    overlay.classList.toggle('active')
}

document.querySelector('#sidebar-close').onclick = () => {
    sidebar.classList.toggle('active')
    overlay.classList.toggle('active')
}


document.getElementById("popup-link").addEventListener("click", function() {
    document.getElementById("popup").style.display = "block";
  });
  
  document.getElementById("close-popup").addEventListener("click", function() {
    document.getElementById("popup").style.display = "none";
  });
  
  document.getElementById("popup-form").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent form submission
    document.getElementById("popup").style.display = "none";
  });
  
    





  
 






  

  




  
  