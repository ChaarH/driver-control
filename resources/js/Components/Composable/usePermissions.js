export function usePermissions(role) {
    const roles = {
        1: 'DEVELOPER',
        2: 'ADMINISTRATOR',
        3: 'OPERATOR',
        4: 'DRIVER'
    }

    return roles[role]
}