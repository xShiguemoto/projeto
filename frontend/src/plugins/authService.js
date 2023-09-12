
export async function isAuthenticated(routeMeta) {
    try {
      return routeMeta.requiresAuth === false; // Retorna verdadeiro se requiresAuth for falso (não requer autenticação)
    } catch (error) {
      console.error('Erro ao verificar autenticação:', error);
      return false;
    }
}