import Vue from 'vue';
import Vuetify from 'vuetify/lib/framework';
import colors from 'vuetify/lib/util/colors'

Vue.use(Vuetify);

export default new Vuetify({
    theme: {
        themes: {
            light: {
                primary: colors.grey.darken4,
                secondary: colors.grey.darken3
            },
            dark: {
                primary: colors.blue.darken3,
                secondary: colors.deepOrange.lighten3
            }
        }
    }
});
