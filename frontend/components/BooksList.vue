<template>

  <a-table
      :dataSource='books'
      :columns='columns'
      rowKey='id'
      bordered
  >
    <template #action='{ record }'>
      <div>


      </div>
    </template>
  </a-table>
  <a-typography-title>Subscribe on new books</a-typography-title>
  <label>Email: <input v-model="email"></label>
  <label>Phone: <input v-model="phone"></label>
  <div>
    <label>Author: </label>
    <select v-model="authorSelect">
      <option v-for="(option, index) in authorList" :value="option.id">
        {{ option.name }}
      </option>
    </select>
    <span>Выбрано: {{ authorSelect }}</span>
  </div>
  <button v-on:click="subscribe">Subscribe</button>

</template>
<script>
import api from '../api';
import {
  PlusOutlined,
  EyeOutlined,
  EditOutlined,
  DeleteOutlined,
  WarningOutlined
} from '@ant-design/icons-vue';
import axios from "axios";

export default {
  components: {
    PlusOutlined,
    EditOutlined,
    EyeOutlined,
    DeleteOutlined,
    WarningOutlined
  },
  data() {
    return {
      books: [],
      columns: [
        {
          title: 'Name',
          dataIndex: 'title',
          key: 'title',
          ellipsis: true
        },
        {
          title: 'Author',
          dataIndex: 'author',
          key: 'author',
        },
        {
          title: 'Release Year',
          dataIndex: 'year_issue',
          key: 'year_issue',
        },
      ],
      email: null,
      phone: null,
      authorSelect: null,
      authorList: app_data.author_list
    };
  },
  methods: {
    async subscribe() {

      const res = await api.subscribe('subscription/subscribe', {
        'email': this.email,
        'phone': this.phone,
        'author_id': this.authorSelect,
      });

      console.log('res', res)
    },
  },
  async mounted() {
    this.books = await api.getList('books/list');
  }
};
</script>