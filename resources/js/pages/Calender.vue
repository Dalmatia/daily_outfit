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
                <v-calendar
                    locale="ja-jp"
                    :type="type"
                    :events="events"
                    color="primary"
                    @change="getEvents"
                >
                    <template v-slot:event="{ event }">
                        <div>
                            {{ event }}
                            <img
                                :src="event.outfit"
                                class="img-fluid"
                            />
                        </div>
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
            events: [],
            outfits: [],
            type: 'month',
        };
    },
    created() {
        axios.get('api/outfits').then(({ data }) => {
            this.outfits = data.outfits;
        });
    },
    methods: {
        rnd(a, b) {
            return Math.floor((b - a + 1) * Math.random()) + a;
        },
        getEvents({ start, end }) {
            this.events = [];
            console.log(start);

            const min = new Date(`${start.date}T00:00:00`);
            const max = new Date(`${end.date}T23:59:59`);
            const days = (max.getTime() - min.getTime()) / 86400000;
            const eventCount = this.rnd(days, days + 20);

            for (let i = 0; i < eventCount; i++) {
                const allDay = this.rnd(0, 3) === 0;
                const firstTimestamp = this.rnd(min.getTime(), max.getTime());
                const first = new Date(
                    firstTimestamp - (firstTimestamp % 900000)
                );
                this.events.push({
                    name: this.outfits[this.rnd(0, this.outfits.length - 1)],
                    start: first,
                    timed: !allDay,
                    // outfit: this.outfits
                });
                console.log(this.events);
            }
        },
    },
};
</script>