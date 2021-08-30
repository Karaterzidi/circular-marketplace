const form = document.getElementById('form')
const submit = document.getElementById('btn')

const customerInputs = document.querySelector('.customer-inputs')
customerInputs.style.display = "none"

const companyInputs = document.querySelector('.company-inputs')
companyInputs.style.display = "none"

const role = document.getElementById('role')

if(role.options[role.selectedIndex].value == "Customer") {
    customerInputs.style.display = "block"
}

if(role.options[role.selectedIndex].value == "Company") {
    companyInputs.style.display = "block"
}

function handleChange(value) {
    submit.disabled = false

    customerInputs.style.display = "none"
    companyInputs.style.display = "none"
    if(value == "Customer") {
        customerInputs.style.display = "block"
    }
    
    if(value == "Company") {
        companyInputs.style.display = "block"
    }
    return;
}

btn.addEventListener('click', (e) => {
    e.preventDefault()
    if(role.options[role.selectedIndex].value == 'Customer') companyInputs.remove()
    if(role.options[role.selectedIndex].value == 'Company') customerInputs.remove()
    form.submit()
})

