const inputDui = document.querySelector("#dui");
const inputTelefono = document.querySelector("#telefono");

// creacion de mascaras
const maskDui = "########-#"
const maskTelefono = "####-####"

let current = ""
let duiNumber = []
let telefonoNumber = []

//agregar el evento para cuando se presione la tecla

inputDui.addEventListener("keydown", (e) => {
    if (e.key === "Tab") {
        return
    }

    e.preventDefault()
    handleInput(maskDui, e.key, duiNumber)
    inputDui.value = duiNumber.join("");
})

inputTelefono.addEventListener("keydown", (e) => {
    if (e.key === "Tab") {
        return
    }

    e.preventDefault()
    handleInput(maskTelefono, e.key, telefonoNumber)
    inputTelefono.value = telefonoNumber.join("");
})

const handleInput = (mask, key, arr) => {
    let numbers = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"]

    if (key === "Backspace" && arr.length > 0) {
        arr.pop()
        return
    }

    if (numbers.includes(key) && arr.length + 1 <= mask.length) {
        if (mask[arr.length] === "-") {
            arr.push(mask[arr.length], key)
        }else {
            arr.push(key)
        }
    }
}