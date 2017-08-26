<template lang="html">
  <div class="chat-message">
  	<small class="username">{{ message.user.name | getInitials }}</small>
  	<span class="pull-right" >{{ message.updated_at | humanReadableTime }}</span>
    <p>{{ message.message }}</p>

  </div>
</template>

<script>
export default {
    props: ['message']
}
</script>

<style lang="css">
.chat-message {
    padding: 1rem;
}
.chat-message > p {
    margin-bottom: .5rem;
}
.chat-message span {
	font-size: 1.2rem;
}
.chat-message small {
	float: left;
	background-color: #CCC;
	margin-right: 10px;
	padding: 8px;
	border-radius: 50%;
	margin-top: -5px;
}
.chat-message:nth-child(even) small {
	background-color: #FFF;
}
.chat-message [data-letters]:before {
  content:attr(data-letters);
  display:inline-block;
  font-size:1em;
  width:2.5em;
  height:2.5em;
  line-height:2.5em;
  text-align:center;
  border-radius:50%;
  background:plum;
  vertical-align:middle;
  margin-right:1em;
  color:white;
}
</style>
