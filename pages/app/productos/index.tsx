import axios from 'axios'
import { Product } from '@/types/Product'
import { useRouter } from 'next/router'
import React, { useEffect, useState } from 'react'
import { Button, message, Popconfirm, Space, Table, Typography } from 'antd'
import { DeleteOutlined, EditOutlined } from '@ant-design/icons'

const { Column } = Table

const Products: React.FC = () => {
  const router = useRouter()
  const [products, setusers] = useState<Product[]>([])

  const init = async () => {
    axios.get('/api/products').then(({ data }) => {
      const products = data.map((item: Product, index: number) => ({
        ...item,
        key: index,
      }))
      setusers(products)
    })
  }

  useEffect(() => {
    Promise.all([init()])
  }, [])

  const remove = async (id: string) => {
    if (id) {
      await axios.delete(`/api/products/${id}`)
      message.success('Documento eliminado')
      init()
    }
  }

  return (
    <>
      <Space className="flex justify-between mb-4">
        <Typography.Title level={3}>Productos</Typography.Title>
        <Space>
          <Button type="primary" className="bg-blue-800" onClick={() => init()}>
            Refrescar
          </Button>
          <Button onClick={() => router.push('/app/productos/insert')}>
            Insertar
          </Button>
        </Space>
      </Space>
      <Table dataSource={products}>
        <Column title="Código" dataIndex="code" key="code" />
        <Column title="Nombre" dataIndex="name" key="nombre" />
        <Column
          title="Precio"
          dataIndex="price"
          key="price"
          render={(_: Product, record: Product) =>
            record.price ? record.price : '0,00'
          }
        />
        <Column title="Stock" dataIndex="total" key="total" />
        <Column
          key="action"
          render={(_: Product, record: Product) => (
            <Space size="middle">
              <a href={`${'/app/productos/'}/${record._id}/edit`}>
                <EditOutlined title="Editar" />
              </a>

              <Popconfirm
                title="¿Eliminar productos?"
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

export default Products
