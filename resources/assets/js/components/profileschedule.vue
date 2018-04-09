<template>
<table class="table table-striped table-dark" style="margin:0px;background-color:#343a40">
  <thead>
    <tr style="color:#dc3545">
      <th scope="col">type</th>
      <th scope="col">name</th>
      <th scope="col">start</th>
      <th scope="col">end</th>
      <th scope="col">game</th>
      <th scope="col">tag</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="schedule in schedules" :class="schedule.class">
    <th scope="row">{{schedule.type}}</th>
    <td>{{schedule.title}}</td>
    <td>{{schedule.start_date}}</td>
    <td>{{schedule.end_date}}</td>
    <td>{{schedule.game}}</td>
    <td>{{schedule.tag}}</td>
    <td></td>
    </tr>
  </tbody>
</table>

</template>
<script>
export default {
  props: ['profile'],
  data:function(){
    return{
      schedules : [],
      sortable : []

    }
  },

  mounted() {

    var scheduleurl = '/api/schedule/'+this.profile.name;
    axios.get(scheduleurl).then(response => {
      this.schedules= JSON.parse(JSON.stringify(response.data));

      function compare(a, b) {
        if (a.start_date < b.start_date)
          return -1;
        if (a.start_date > b.start_date)
          return 1;
        return 0;
      }

      for (var schedule in this.schedules) {
        this.sortable.push(this.schedules[schedule]);
      }

      this.schedules = this.sortable.sort(compare);
    });

  }
}

</script>
