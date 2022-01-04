<template>
    <div class="card card-body" style="height: 80vh;">
        <FullCalendar ref="fullCalendar" :options="calendarOptions" />
        <div class="modal fade exampleModal" id="newEvent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <travel-calendar-create @status="pushEvent" :modetype="modetype" :traveltype="traveltype" ref="create"></travel-calendar-create>
        </div>

        <div class="modal fade exampleModal" id="showEvent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <travel-view :profile="profile" ref="view"></travel-view>
        </div>
    </div>
</template>

<script>
    import '@fullcalendar/core/vdom';
    import FullCalendar from '@fullcalendar/vue';
    import dayGridPlugin from '@fullcalendar/daygrid';
    import listPlugin from '@fullcalendar/list';
    import timeGridPlugin from '@fullcalendar/timegrid';
    import interactionPlugin from '@fullcalendar/interaction';
    import resourceTimelinePlugin from '@fullcalendar/resource-timeline';

    export default {
        props: ['traveltype','modetype','profile'],
        data(){
            return {
                currentUrl: window.location.origin,
                calendarOptions: {
                    height: "auto",
                    // expandRows: true,
                    headerToolbar: {
                        left:   'title',
                        center: '',
                        right:  'today prev,next resourceTimelineDay,resourceTimelineMonth'
                    },
                    plugins: [ dayGridPlugin, interactionPlugin, listPlugin, timeGridPlugin, resourceTimelinePlugin],
                    initialView: 'resourceTimelineDay',
                    eventDisplay: 'block',
                    selectable: true,
                    slotMinTime: "08:00:00",
			        slotMaxTime: "18:00:00",
                    nextDayThreshold: '00:00',
                    allDay: false,
                    timeFormat: 'H(:mm)',
                    eventClick: this.handleEvent,
                    select: this.handleSelect,
                    fixedWeekCount: true,
                    events: [],
                    eventOverlap: false,
                    // editable: true,
                    // droppable: true,
                    resourceGroupField: 'group',
                    resources: [],
                    resourceAreaWidth: '270px',
                    validRange: {
                        start: new Date()
                    },
                    
                },
            }
        },

        created(){
            this.fetchEvent();
            this.fetchVehicle();
        },

        methods : {
            fetchEvent() {
                axios.get(this.currentUrl + '/request/travel/lists')
                .then(response => {
                    this.calendarOptions.events = response.data.data;
                })
                .catch(err => console.log(err));
            },

            fetchVehicle() {
                axios.get(this.currentUrl + '/request/admin/vehicles')
                .then(response => {
                    this.calendarOptions.resources = response.data.data;
                })
                .catch(err => console.log(err));
            },

            handleEvent(event)
            {
               this.$refs.view.set(event.event.id,'id');
               $("#showEvent").modal("show");
            },

            pushEvent(event){
                this.calendarOptions.events.push(event);
            },

            handleSelect(selectionInfo)
            {    
                let type = selectionInfo.view.type; //this.$refs.fullCalendar.getApi().currentData.currentViewType;
    
                switch(type){ //timeGridDay , timeGridWeek, dayGridMonth
                    case 'resourceTimelineDay':
                        let y = (new Date(selectionInfo.endStr));
                        let z = (new Date(selectionInfo.startStr));
                        selectionInfo.endStr = z.toISOString().split('T')[0];
                        selectionInfo.startStr = z.toISOString().split('T')[0];
                        this.$refs.create.set(selectionInfo);
                        $("#newEvent").modal("show");
                    break;
                    case 'resourceTimelineWeek':
                        this.$refs.create.set(selectionInfo);
                        $("#newEvent").modal("show");
                    break;
                    case 'resourceTimelineMonth':
                        let a = (new Date(selectionInfo.endStr));
                        let b = (new Date(selectionInfo.end));
                        a.setDate(a.getDate() - 1);
                        b.setDate(b.getDate() - 1);
                        selectionInfo.endStr = a.toISOString().split('T')[0];
                        selectionInfo.end = b;

                        if(selectionInfo.startStr == selectionInfo.endStr ){
                            this.$refs.fullCalendar.getApi().changeView('resourceTimelineDay',selectionInfo.startStr);
                        }else{
                            this.$refs.create.set(selectionInfo);
                            $("#newEvent").modal("show");
                        }
                    break;
                }
            }
        }, components : {  FullCalendar }
    }
</script>

<style>
    .krad {
       line-height: 240%; 
       border-radius: 3px;
       margin: 1px;
    }
    .fc-license-message {
        display: none;
    }
</style>