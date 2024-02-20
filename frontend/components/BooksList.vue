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
      ]
    };
  },
  methods: {

  },
  async mounted() {
    this.books = await api.getList('books/list');
  }
};
</script>