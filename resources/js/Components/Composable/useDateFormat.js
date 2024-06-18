import { format } from 'date-fns'

export function useDateFormat(param) {
    return format(param, 'dd/MM/yy H:ii:s')
}