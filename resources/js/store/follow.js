import axios from 'axios';

const state = {
    status: null,
};
const getters = {
    check: (state) => !!state.user,
};
const mutations = {
    setStatus(state, status) {
        state.status = status;
    },
};
const actions = {
    async pushFollow(context, data) {
        await axios
            .post('/api/follow', data)
            .then((result) => {
                context.commit('setStatus', result.data);
            })
            .catch((error) => {
                console.log(error);
            });
    },
    async deleteFollow(context, data) {
        await axios
            .delete('/api/follow', { data: data })
            .then((result) => {
                context.commit('setStatus', result.data);
            })
            .catch((error) => {
                console.log(error);
            });
    },
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
};
