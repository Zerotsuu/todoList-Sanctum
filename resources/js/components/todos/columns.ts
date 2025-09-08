import { Todo } from '@/types'
import { h } from 'vue'
import { ColumnDef } from '@tanstack/vue-table'
// import { Rows } from 'lucide-vue-next'

export const columns: ColumnDef<Todo>[] = [
  {
    accessorKey: 'title',
    header: () => h('div', { class: 'text-left font-semibold' }, 'Title'),
    cell: ({ row }) => {
      const title = row.getValue('title') as string
      return h('div', { class: 'text-left' }, title)
    },
  },
    {
    accessorKey: 'status',
    header: () => h('div', { class: 'text-left font-semibold' }, 'Status'),
    cell: ({ row }) => {
      const status = row.getValue('status') as string
      return h('div', { class: 'text-left' }, status)
    },
  },
]