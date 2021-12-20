<template>
    <v-row class="fill-height">
        <v-col>
            <v-sheet height="64">
                <v-toolbar flat>
                    <v-menu bottom right>
                        <template v-slot:activator="{ on }">
                            <v-btn outlined color="gray darken-2" v-on="on">
                                <span>{{ type }}</span>
                            </v-btn>
                        </template>

                        <v-list>
                            <v-list-item @click="type = 'day'">
                                <v-list-item-title>Day</v-list-item-title>
                            </v-list-item>
                            <v-list-item @click="type = 'week'">
                                <v-list-item-title>Week</v-list-item-title>
                            </v-list-item>
                            <v-list-item @click="type = 'month'">
                                <v-list-item-title>Month</v-list-item-title>
                            </v-list-item>
                        </v-list>
                    </v-menu>
                </v-toolbar>
            </v-sheet>
            <v-sheet height="150vh">
                <v-calendar locale="ja-jp" :type="type" color="primary">
                </v-calendar>
            </v-sheet>
        </v-col>
    </v-row>
</template>

<script>
export default {
    name: 'Calender',
    data(){
        return {
            type: 'month'
        }
    }
};
</script>