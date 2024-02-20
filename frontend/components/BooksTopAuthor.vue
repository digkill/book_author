<template>

  <a-table
      :dataSource='authors'
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
      authors: [],
      columns: [
        {
          title: 'Author',
          dataIndex: 'name',
          key: 'name',
          ellipsis: true
        },
        {
          title: 'Release Year',
          dataIndex: 'year_issue',
          key: 'year_issue',
        },
        {
          title: 'Count Book',
          dataIndex: 'count_book',
          key: 'count_book',
        },
      ]
    };
  },
  methods: {

  },
  async mounted() {
    this.authors = await api.getTop10('authors/top10');
  }
};
</script>