import axios from 'axios'
import { User } from '@/types/User'
import { useRouter } from 'next/router'
import React, { useEffect, useState } from 'react'
import { Button, message, Popconfirm, Space, Table } from 'antd'
import { DeleteOutlined, EditOutlined } from '@ant-design/icons'

const { Column } = Table

const Clients: React.FC = () => {
  const router = useRouter()
  const [clients, setusers] = useState<User[]>([])

  const init = async () => {
    axios.get('/api/users').then(({ data }) => {
      const users = data.map((item: User, index: number) => ({
        ...item,
        key: index,
      }))
      setusers(users)
    })
  }

  useEffect(() => {
    Promise.all([init()])
  }, [])

  const remove = async (id: string) => {
    if (id) {
      await axios.delete(`/api/users/${id}`)
      message.success('Documento eliminado')
      init()
    }
  }

  return (
    <>
      <Space className="flex justify-end mb-4">
        <Button type="primary" className="bg-blue-800" onClick={() => init()}>
          Refrescar
        </Button>
        <Button onClick={() => router.push('/app/clientes/insert')}>
          Insertar
        </Button>
      </Space>
      <Table dataSource={clients}>
        <Column title="Usuario" dataIndex="username" key="username" />
        <Column
          title="Contraseña"
          dataIndex="password"
          key="password"
          render={(row) => row.replace(/./gi, '*')}
        />
        <Column title="Email" dataIndex="email" key="email" />
        <Column
          key="action"
          render={(_: User, record: User) => (
            <Space size="middle">
              <a href={`${'/app/admin/usuarios/'}/${record._id}/edit`}>
                <EditOutlined title="Editar" />
              </a>

              <Popconfirm
                title="¿Eliminar usuario?"
                okButtonProps={{
                  type: 'default',
                }}
                onConfirm={() => remove(record._id)}
              >
                <DeleteOutlined title="Eliminar" />
              </Popconfirm>
            </Space>
          )}
        />
      </Table>
    </>
  )
}

export default Clients
