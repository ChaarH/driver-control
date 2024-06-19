export function useCalculateStarRate(total_runs, likes, dislikes) {
    // const likesWeight = 0.8
    // const dislikesWeight = 0.2
    //
    // if (total_runs === 0) return '0';
    //
    // let rating = ((likes * likesWeight) - (dislikes * dislikesWeight)) / total_runs;
    //
    // rating = Math.max(0, Math.min(5, rating));

    let rating = (likes * 100) / total_runs

    rating = (rating * 5) / 100

    return rating.toFixed(1);
}