import toastr from 'toastr';

// Configuração padrão do Toastr
const toastrConfig = {
    closeButton: true,
    progressBar: true,
    preventDuplicates: true,
    newestOnTop: true,
    showDuration: '300',
    hideDuration: '1000',
    timeOut: '0',
    extendedTimeOut: '0',
    showEasing: 'swing',
    hideEasing: 'linear',
    showMethod: 'fadeIn',
    hideMethod: 'fadeOut'
};

// Configuração personalizada para mensagens de sucesso
toastr.options.success = {
    ...toastrConfig,
    iconClass: 'toast-success-icon',
    backgroundClass: 'toast-success-background'
};

// Configuração personalizada para mensagens de aviso
toastr.options.warning = {
    ...toastrConfig,
    iconClass: 'toast-warning-icon',
    backgroundClass: 'toast-warning-background'
};

// Configuração personalizada para mensagens de erro
toastr.options.error = {
    ...toastrConfig,
    iconClass: 'toast-error-icon',
    backgroundClass: 'toast-error-background'
};

export default toastrConfig;
