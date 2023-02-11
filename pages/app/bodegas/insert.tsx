import axios from 'axios'
import $rules from '@/assets/rules'
import { Warehouse } from '@/types/Warehouse'
import { useRouter } from 'next/router'
import {
  Button,
  Form,
  Input,
  InputNumber,
  message,
  Typography
} from 'antd'

export default function FormClient() {
  const router = useRouter()
  const [form] = Form.useForm()

  const onSubmit = (data: Warehouse) => {
    console.log(data)
    if (router.query.id) {
      axios.put(`/api/warehouses/${router.query.id}`, data)
      message.success('Documento actualizado')
    } else {
      axios.post('/api/warehouses', data)
      message.success('Documento guardado correctamente')
    }
    router.push('/app/bodegas')
  }

  const cssColumnas = 'grid grid-cols-1 md:grid-cols-3 gap-x-6'

  return (
    <Form form={form} layout="vertical" onFinish={onSubmit}>
      <Typography.Title level={4}>
        Datos
      </Typography.Title>
      <div className={cssColumnas}>
        <Form.Item
          name="code"
          label="Código"
          rules={[$rules.required()]}
        >
          <Input placeholder="Ingrese el código" />
        </Form.Item>

        <Form.Item
          name="name"
          label="Nombre"
          rules={[$rules.min(3)]}
        >
          <Input placeholder="Ingrese el nombre" />
        </Form.Item>

        <Form.Item
          name="dimension"
          label="Dimensión (m3)"
        >
          <InputNumber className='w-full' placeholder="Ingrese el tamaño de la bodega en metros" min={1} />
        </Form.Item>
      </div>
      <Typography.Title level={4}>
        Direcciones
      </Typography.Title>
      <div className={cssColumnas}>
        <Form.Item
          name="parish"
          label="Parroquia"
        >
          <Input placeholder="Ingrese la parroquia" />
        </Form.Item>

        <Form.Item
          name="sector"
          label="Sector"
        >
          <Input placeholder="Ingrese el sector" />
        </Form.Item>

        <Form.Item
          name="neighborhood"
          label="Barrio"
        >
          <Input placeholder="Ingrese el barrio" />
        </Form.Item>

        <Form.Item
          name="main_street"
          label="Calle principal"
        >
          <Input placeholder="Ingrese la calle principal" />
        </Form.Item>

        <Form.Item
          name="back_street"
          label="Calle secundaria"
        >
          <Input placeholder="Ingrese la calle secundaria" />
        </Form.Item>

        <Form.Item
          name="house_number"
          label="Número de casa"
        >
          <Input placeholder="Ingrese el número de casa" />
        </Form.Item>

        <Form.Item
          name="reference"
          label="Referencia"
        >
          <Input placeholder="Ingrese la referencia" />
        </Form.Item>
      </div>
      
      <Button type="primary" className=" bg-blue-400" htmlType="submit">
        Guardar
      </Button>
      <Button className="ml-3" onClick={() => router.push('/app/bodegas')}>
        Cancelar
      </Button>
    </Form>
  )
}
