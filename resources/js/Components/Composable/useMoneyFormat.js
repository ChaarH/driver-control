let BR_Real = new Intl.NumberFormat('pt-BR', {
    style: 'currency',
    currency: 'BRL'
})

export function useMoneyFormat(param) {
    return BR_Real.format(param)
}