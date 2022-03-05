const state = {
    following_check: false,
};
const mutations = {
    follow_action(state, id) {
        const path = '/api/follow';
        axios
            .post(path, {
                user_id: id,
            })
            .then((res) => {
                console.log(res);
            })
            .catch(function (error) {
                console.log(error);
            });
    },
    follow_check(state, id) {
        var array = ['/api/follow_check'];
        let url = array.join('');
        axios
            .get(url)
            .then((res) => {
                if (res.data == 1) {
                    state.following_check = true;
                } else {
                    state.following_check = false;
                }
            })
            .catch(function (error) {
                console.log(error);
            });
    },
};
const actions = {
    follow_do({ commit }, id) {
        commit('follow_action', id);
    },
    follow_check({ commit }, id) {
        commit('follow_check', id);
    },
};

export default {
    namespaced: true,
    state,
    mutations,
    actions,
};
