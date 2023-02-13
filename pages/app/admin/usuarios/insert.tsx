import axios from 'axios'
import { useEffect } from 'react'
import $rules from '@/assets/rules'
import { User } from '@/types/User'
import { useRouter } from 'next/router'
import { showError } from '@/assets/utils'
import { Button, Card, Form, Input, message, Space } from 'antd'

export default function FormClient() {
  const router = useRouter()
  const [form] = Form.useForm()

  useEffect(() => {
    if (router.query.id) {
      axios.get(`/api/users/${router.query.id}`).then(({ data }) => {
        form.setFieldsValue(data)
      })
    }
  }, [router.query.id])

  const onSubmit = async (data: User) => {
    try {
      if (router.query.id) {
        await axios.put(`/api/users/${router.query.id}`, data)
        message.success('Documento actualizado')
      } else {
        await axios.post('/api/users', data)
        message.success('Documento guardado correctamente')
      }
      router.push('/app/clientes')
    } catch (e) {
      showError(e)
    }
  }

  const cssColumnas = 'grid grid-cols-1 md:grid-cols-3 gap-x-6'

  return (
    <Form
      form={form}
      initialValues={{ state: 'activo' }}
      layout="vertical"
      onFinish={onSubmit}
    >
      <Card>
        <div className={cssColumnas}>
          <Form.Item
            name="username"
            label="Usuario"
            rules={[$rules.required()]}
          >
            <Input placeholder="Ingrese un usuario" />
          </Form.Item>
          <Form.Item
            name="password"
            label="Contraseña"
            rules={[$rules.required()]}
          >
            <Input.Password placeholder="Ingrese una contraseña" />
          </Form.Item>
          <Form.Item name="email" label="Email">
            <Input placeholder="Ingrese el correo" />
          </Form.Item>
        </div>
      </Card>

      <Space className="mt-4 flex justify-end mr-4">
        <Button type="primary" className=" bg-blue-400" htmlType="submit">
          Guardar
        </Button>
        <Button
          className="ml-3"
          onClick={() => router.push('/app/admin/usuarios')}
        >
          Cancelar
        </Button>
      </Space>
    </Form>
  )
}
