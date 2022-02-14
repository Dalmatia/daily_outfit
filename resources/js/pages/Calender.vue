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
                    <v-btn fab text small color="grey darken-2" @click="prev">
                        <v-icon small> mdi-chevron-left </v-icon>
                    </v-btn>
                    <v-btn fab text small color="grey darken-2" @click="next">
                        <v-icon small> mdi-chevron-right </v-icon>
                    </v-btn>
                    <v-toolbar-title v-if="$refs.calendar">
                        {{ $refs.calendar.title }}
                    </v-toolbar-title>
                    <v-spacer></v-spacer>
                </v-toolbar>
            </v-sheet>
            <v-sheet height="200vh">
                <v-calendar
                    locale="ja-jp"
                    ref="calendar"
                    v-model="value"
                    :weekdays="weekday"
                    :type="type"
                    :events="events"
                    :event-overlap-mode="mode"
                    :event-height="200"
                    @change="getEvents"
                >
                    <template v-slot:event="{ event }">
                        <v-row>
                            <v-col>
                                <router-link
                                    :to="{
                                        name: 'outfitDetail',
                                        params: { id: event.id.toString() },
                                    }"
                                >
                                    <img
                                        style="
                                            height: 200px;
                                            width: 100%;
                                            object-fit: cover;
                                        "
                                        :src="event.url"
                                    />
                                </router-link>
                            </v-col>
                        </v-row>
                    </template>
                </v-calendar>
            </v-sheet>
        </v-col>
    </v-row>
</template>

<script>
export default {
    name: 'Calender',
    data() {
        return {
            value: '',
            mode: 'stack',
            weekday: [0, 1, 2, 3, 4, 5, 6],
            events: [],
            outfits: [],
            type: 'month',
        };
    },
    mounted() {
        this.$refs.calendar.checkChange();
    },
    created() {
        axios.get('/api/outfits').then(({ data }) => {
            this.outfits = data.outfits;
            this.getEvents();
        });
    },
    methods: {
        prev() {
            this.$refs.calendar.prev();
        },
        next() {
            this.$refs.calendar.next();
        },
        getEvents() {
            const events = [];
            for (var i = 0; i < this.outfits.length; i++) {
                const first = new Date(this.outfits[i].outfit_date);
                events.push({
                    name: this.outfits[i].name,
                    url: this.outfits[i].url,
                    id: this.outfits[i].id,
                    start: first,
                });
            }
            this.events = events;
        },
    },
};
</script>