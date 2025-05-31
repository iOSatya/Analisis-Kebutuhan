import Swal from "sweetalert2";

export const alertSuccess = async (message) => {
    return Swal.fire({
        icon: 'success',
        title: 'Sukses',
        text: message
    })
}

export const alertError = async (message) => {
    return Swal.fire({
        icon: 'error',
        title: 'Ups',
        text: message,
    })
}

export const alertWarning = async (message) => {
    return Swal.fire({
        icon: 'warning',
        title: 'Ups',
        text: message,
    })
}

export const alertInfo = async (message) => {
    return Swal.fire({
        icon: 'info',
        title: 'Informasi',
        text: message
    })
}